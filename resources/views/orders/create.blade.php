@extends('layouts.app')
@php
    $counter = 0
@endphp
@section('content')
    <h1 class="text-center text-uppercase">List of Products</h1>

    <div class="text-center">
        <form action="{{ route('orders.store') }}" class="d-inline" method="POST">
            @csrf
            <button class="btn btn-success" type="submit">Check out</button>
        </form>
    </div>
    {{-- Table Striped can add the zebra stripes to the table --}}
    <table class="table table-striped table-bordered caption-top">
        <caption>List of Products</caption>
        <thead class='align-bottom'>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price (RM)</th>
        </thead>
        <tbody>   
            @forelse ($cart->products as $product)
            <tr>
                <td><img src="{{ asset($product->images->first()->path) }}" alt="" width="150"></td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                {{-- This line is to get the quantity from the pivot table --}}
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ number_format($product->total,2) }}</td>
            </tr>
                
                
            @empty
                <tr>
                    <td cols=6 >No Product Available</td>
                </tr>
            @endforelse
            <tr>
                <td class="fw-bold text-end" colspan="4">Total</td>
                <td>{{ $cart->total }}</td>
            </tr>
        </tbody>
    </table>
@endsection