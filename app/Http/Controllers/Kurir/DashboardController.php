<?php

namespace App\Http\Controllers\Kurir;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua order yang belum diambil kurir
        $orders = Order::where('status', 'pending')->whereNull('courier_id')->latest()->get();
        return view('pages.kurir.dashboard', compact('orders'));
    }

    public function accept(Order $order)
    {
        $order->update([
            'courier_id' => auth()->id(),
            'status' => 'delivering'
        ]);
        return back()->with('success', 'Order berhasil diterima. Silakan antar ke tujuan!');
    }

    public function complete(Order $order)
    {
        $order->update(['status' => 'completed']);
        return back()->with('success', 'Pesanan telah sukses diantar ke pengguna!');
    }
}