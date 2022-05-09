@extends('layouts.app')
@php
    $counter = 0
@endphp
@section('content')

    <h4 class="text-center">Grand Total: RM {{ number_format($order->total,2) }}</h4>
    <div class="text-center">
        <form action="{{ route('orders.payments.store', ['order' => $order->id]) }}" class="d-inline" method="POST">
            @csrf
            <button class="btn btn-success" type="submit">Pay</button>
        </form>
    </div>
   
@endsection