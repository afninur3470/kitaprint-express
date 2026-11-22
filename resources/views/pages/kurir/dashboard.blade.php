@extends('layouts.app')
@section('content')
<div class="page-heading"><div><span>KURIR</span><h1>Order Tersedia</h1></div></div>
@foreach($available as $order)
<div class="white-card p-4 mb-2 flex justify-between items-center">
    <div><strong>{{ $order->document_name }}</strong></div>
    <form action="{{ route('kurir.order.accept', $order->id) }}" method="POST">
        @csrf
        <button type="submit" class="web-button primary">Terima Order</button>
    </form>
</div>
@endforeach
@endsection