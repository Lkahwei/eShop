@extends('layouts.app')
@php
    $counter = 0
@endphp
@section('content')

    <h1 class='text-center'>Products Table</h1>
    <a href="products/create" class="btn btn-primary" role="button">Create New Product</a>
    {{-- Table Striped can add the zebra stripes to the table --}}
    <table class="table table-striped table-bordered caption-top">
        <caption>List of Products</caption>
        <thead class='align-bottom'>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Stock</th>
            <th scope="col">Status</th>
        </thead>
        <tbody>
            
            
            @forelse ($products as $product)
            <tr>
                
                <td>{{ $counter+=1 }}</td>
                <td><a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->title }}</a></td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->status }}</td>
                <td><a href="{{ route('products.edit', ['product' => $product->id]) }}">Edit</a></td>
                <td>
                    <form action = "{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                        @csrf
                        @method('Delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                
                
            </tr>
                
                
            @empty
                <tr>
                    <td cols=6>No Product Available</td>
                </tr>
                
            @endforelse
            
        </tbody>
    </table>
@endsection