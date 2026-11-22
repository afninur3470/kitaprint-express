<?php

namespace App\Http\Controllers\Kurir;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index() {
    // Kurir hanya bisa mengambil order yang sudah selesai dicetak (ready)
    $availableOrders = \App\Models\Order::where('status', 'ready')->whereNull('courier_id')->latest()->get();
    $activeOrders = \App\Models\Order::where('courier_id', auth()->id())->where('status', 'delivering')->latest()->get();
    
    return view('pages.kurir.dashboard', compact('availableOrders', 'activeOrders'));
}

public function accept(\App\Models\Order $order) {
    $order->update(['courier_id' => auth()->id(), 'status' => 'delivering']);
    return back()->with('success', 'Order diterima!');
}

public function complete(\App\Models\Order $order) {
    $order->update(['status' => 'completed']);
    return back()->with('success', 'Pesanan selesai diantar!');
}
}