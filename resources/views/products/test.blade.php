@extends('layouts.app')

@section('content')
    @if (empty($products))
        <div class="alert alert-warning">
            The list of products is empty
        </div>
    @else
        <div class="container">
            <div class="row">
            @foreach ($products as $product)
                <div class="col-4">
                    @include('components.product-card')
                </div>
                @endforeach
            </div>

        </div>
    @endif
@endsection