<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Store;
use App\Models\OrderSplit;
use App\Models\CourierWallet;
use App\Services\DeliveryService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    // ============== 1. ALUR PENGGUNA ==============
    public function upload() { return view('pages.app.order.upload'); }

    public function processUpload(Request $request) {
        $request->validate(['document' => 'required|mimes:pdf,docx|max:25000']);
        $path = $request->file('document')->store('documents', 'public');
        
        session([
            'order_file' => $path, 
            'order_filename' => $request->file('document')->getClientOriginalName(), 
            'order_pages' => rand(10, 100) // Simulasi AI deteksi halaman
        ]);
        return redirect()->route('order.configure');
    }

    public function configure() { return view('pages.app.order.configure'); }

    public function checkout() {
        $deliveryService = new DeliveryService();
        $isCourierAvailable = $deliveryService->isCourierAvailable();
        $deliveryOptions = $deliveryService->getAvailableDeliveryOptions();
        
        $pages = session('order_pages', 10);
        $basePrice = $pages * 500;

        return view('pages.app.order.checkout', compact('isCourierAvailable', 'deliveryOptions', 'basePrice'));
    }

    public function processCheckout(Request $request) 
    {
        // 1. CEK TOKO (Jika kosong, buat otomatis)
        $store = Store::first();
        if (!$store) {
            $store = Store::create([
                'user_id' => 1, // Anggap ID 1 adalah admin/mitra
                'name' => 'Fotocopy Berkah Jaya',
                'slug' => 'fotocopy-berkah-jaya',
                'business_type' => 'percetakan',
                'phone' => '08123456789',
                'email' => 'berkah@test.com',
                'address' => 'Jl. Pendidikan No 1',
                'city' => 'Pekanbaru',
                'postal_code' => '28281',
                'ktp_number' => '1234567890123456',
                'ktp_photo' => 'dummy.jpg',
                'bank_name' => 'BCA',
                'bank_account_number' => '123456',
                'bank_account_name' => 'Admin',
                'status' => 'approved'
            ]);
        }

        // 2. HITUNG BIAYA
        $pages = session('order_pages', 10);
        $basePrice = $pages * 500;
        $shipping = ($request->delivery_type === 'self_pick') ? 0 : 5000;
        $scheduledAt = ($request->delivery_type === 'scheduled_courier') ? Carbon::tomorrow()->setTime(7, 0) : null;

        // 3. BUAT PESANAN
        $order = Order::create([
            'order_number' => 'KP-' . date('Ymd') . '-' . rand(1000, 9999),
            'user_id' => auth()->id(),
            'store_id' => $store->id,
            'document_name' => session('order_filename', 'Dokumen.pdf'),
            'file_path' => session('order_file'),
            'total_pages' => $pages,
            'paper_size' => $request->paper_size ?? 'A4',
            'is_binding' => $request->has('is_binding'),
            'binding_color' => $request->has('is_binding') ? $request->binding_color : null,
            'is_express' => $request->has('is_express'),
            'print_price' => $basePrice,
            'binding_price' => $request->has('is_binding') ? 15000 : 0,
            'express_price' => $request->has('is_express') ? 2000 : 0,
            'shipping_price' => $shipping,
            'total_price' => $basePrice + ($request->has('is_binding') ? 15000 : 0) + ($request->has('is_express') ? 2000 : 0) + $shipping + 1000,
            'delivery_type' => $request->delivery_type ?? 'courier',
            'scheduled_at' => $scheduledAt,
            'payment_method' => $request->payment_method ?? 'QRIS',
            'status' => 'pending'
        ]);

        // 4. SIMPAN SPLITBILL
        if ($request->has('is_splitbill')) {
            OrderSplit::create([
                'order_id' => $order->id, 
                'friend_name' => 'Budi', 
                'amount' => $order->total_price / 2, 
                'status' => 'paid'
            ]);
            OrderSplit::create([
                'order_id' => $order->id, 
                'friend_name' => 'Sari', 
                'amount' => $order->total_price / 2, 
                'status' => 'unpaid'
            ]);
        }

        // 5. BERSIHKAN SESI & REDIRECT
        session()->forget(['order_file', 'order_filename', 'order_pages']);
        
        return redirect()->route('order.tracking')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function tracking() {
        $order = Order::where('user_id', auth()->id())->latest()->first();
        if (!$order) return redirect()->route('home')->with('error', 'Belum ada pesanan.');
        return view('pages.app.order.tracking', compact('order'));
    }

    // ============== 2. ALUR MITRA ==============
    public function mitraDashboard() {
        $store = auth()->user()->store;
        $incoming = Order::where('store_id', $store->id)->where('status', 'pending')->latest()->get();
        $processing = Order::where('store_id', $store->id)->whereIn('status', ['printing', 'ready'])->latest()->get();
        return view('pages.mitra.dashboard', compact('incoming', 'processing'));
    }

    public function mitraUpdateStatus(Request $request, Order $order) {
        $order->update(['status' => $request->status]);
        return back()->with('success', "Status pesanan diubah ke $request->status");
    }

    // ============== 3. ALUR KURIR ==============
    public function kurirDashboard() {
        $available = Order::where('status', 'ready')->whereNull('courier_id')->latest()->get();
        $active = Order::where('courier_id', auth()->id())->where('status', 'delivering')->latest()->get();
        return view('pages.kurir.dashboard', compact('available', 'active'));
    }

    public function kurirAccept(Order $order) {
        $order->update(['courier_id' => auth()->id(), 'status' => 'delivering']);
        return back()->with('success', 'Order diterima!');
    }

    public function kurirComplete(Order $order) {
        $order->update(['status' => 'completed']);
        // Tambah saldo kurir
        $wallet = CourierWallet::firstOrCreate(['user_id' => auth()->id()]);
        $wallet->increment('balance', $order->shipping_price);
        return back()->with('success', 'Pesanan selesai diantar!');
    }

    // ============== 4. ALUR ADMIN ==============
    public function adminDashboard() {
        $stores = Store::with('owner')->latest()->get();
        return view('pages.admin.dashboard', compact('stores'));
    }

    public function adminVerify($id) 
    {
        $store = Store::findOrFail($id);
        $store->update(['status' => 'approved']);
        $store->owner->assignRole('mitra');
        return back()->with('success', 'Toko disetujui!');
    }
}