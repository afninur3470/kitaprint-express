<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
    $store = auth()->user()->store;
    $incomingOrders = \App\Models\Order::where('store_id', $store->id)->where('status', 'pending')->latest()->get();
    $processingOrders = \App\Models\Order::where('store_id', $store->id)->whereIn('status', ['printing', 'ready'])->latest()->get();
    
    $ordersToday = \App\Models\Order::where('store_id', $store->id)->whereDate('created_at', today())->count();
    $revenueToday = \App\Models\Order::where('store_id', $store->id)->whereDate('created_at', today())->sum('total_price');

    return view('pages.mitra.dashboard', compact('incomingOrders', 'processingOrders', 'ordersToday', 'revenueToday'));
}

public function updateStatus(Request $request, \App\Models\Order $order) {
    $order->update(['status' => $request->status]);
    return back()->with('success', 'Status pesanan diperbarui!');
}
}