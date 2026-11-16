<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil ID toko milik user yang login
        $store = auth()->user()->store;
        if (!$store) return redirect()->route('home')->with('error', 'Anda belum mendaftarkan toko.');

        // Hitung pendapatan & pesanan hari ini
        $ordersToday = Order::where('store_id', $store->id)->whereDate('created_at', today())->count();
        $revenueToday = Order::where('store_id', $store->id)->whereDate('created_at', today())->where('status', '!=', 'cancelled')->sum('total_price');
        
        // Ambil pesanan berdasarkan status
        $incomingOrders = Order::where('store_id', $store->id)->where('status', 'pending')->latest()->get();
        $processingOrders = Order::where('store_id', $store->id)->whereIn('status', ['printing', 'ready'])->latest()->get();

        return view('pages.mitra.dashboard', compact('store', 'ordersToday', 'revenueToday', 'incomingOrders', 'processingOrders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:printing,ready,completed']);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan diperbarui menjadi: ' . $request->status);
    }
}