<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function upload() {
        return view('pages.app.order.upload');
    }

    public function configure() {
        return view('pages.app.order.configure');
    }

    public function checkout() {
        return view('pages.app.order.checkout');
    }

    public function processCheckout(Request $request) {
        // Simulasi pengambilan Toko ID 1 (Fotocopy Berkah Jaya)
        $storeId = 1; 

        $order = Order::create([
            'order_number' => 'KP-' . date('Ymd') . '-' . rand(1000, 9999),
            'user_id' => auth()->id(),
            'store_id' => $storeId,
            'document_name' => 'Laporan PKL.pdf',
            'total_pages' => 68,
            'paper_size' => 'A4',
            'is_binding' => true,
            'binding_color' => 'Biru',
            'is_express' => true,
            'print_price' => 34000,
            'binding_price' => 15000,
            'express_price' => 2000,
            'shipping_price' => 5000,
            'total_price' => 56000,
            'delivery_type' => $request->input('delivery', 'courier'),
            'payment_method' => $request->input('payment', 'qris'),
            'is_splitbill' => $request->has('is_splitbill'),
            'status' => 'pending'
        ]);

        return redirect()->route('order.tracking')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function tracking() {
        $order = Order::where('user_id', auth()->id())->latest()->first();
        if (!$order) {
            return redirect()->route('home')->with('error', 'Anda belum memiliki pesanan.');
        }
        return view('pages.app.order.tracking', compact('order'));
    }

    public function rating() {
        return view('pages.app.order.rating');
    }
}