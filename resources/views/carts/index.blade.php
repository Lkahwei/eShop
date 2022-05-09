@extends('layouts.app')

@section('content')
    <h1 class="text-center fw-bold text-uppercase">Your Cart</h1>
    
    @if (!isset($cart) || $cart->products->isEmpty())
        <div class="alert alert-warning">
            The list of products is empty!
        </div>
    @else
        <div class="d-flex m-3 justify-content-center">
            <a href="{{ route('orders.create') }}" class="btn btn-success fs-5">Start Order</a>
        </div>
        
        <div class="container">
            <div class="row">
                @foreach ($cart->products as $product)
                    <div class="col-12 col-sm-6  d-flex align-items-stretch">
                        @include('components.product-card')
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection