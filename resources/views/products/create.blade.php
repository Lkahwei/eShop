@extends('layouts.app')

@section('content')
    <h1 class="text-center">Create Product</h1>
    
    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        
        @csrf
        {{-- The old('name') will use back the old value if the form is not validate --}}
        <label for="productName" class="form-label">Product Name</label>
        <input type="text" name="productName" id="productName" class="form-control" placeholder="Product Name" value="{{ old('productName') }}">
    
        <label for="productDescription" class="form-label">Description</label>
        <input type="text" name="productDescription" id="productDescription" class="form-control" placeholder="Description" value="{{ old('productDescription') }}">
    
        <label for="productPrice" class="form-label">Product Price</label>
        <input type="number" name="productPrice" id="productPrice" class="form-control" placeholder="Product Price" step="0.01" value="{{ old('productPrice') }}">
    
        <label for="productStock" class="form-label">Product Stock</label>
        <input type="number" name="productStock" id="productStock" class="form-control" placeholder="Product Stock" value="{{ old('productStock') }}">
    
        <label for="productStatus" class="form-label">Product Status</label>
        {{-- <input class="form-control" list="productStatusList" id="productStatus" name="productStatus">
        <datalist id="productStatusList">
            <option value="available">
            <option value="unavailable">
        </datalist> --}}

        <select name="productStatus" id="productStatus" class="form-select">
            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }} > Available </option>
            <option value="unavailable" {{ old('status')   == 'unavailable' ? 'selected' : '' }}> Unavailable </option>
        </select>

        <label for="productStock" class="form-label">{{ __('Product Images') }}</label>
        <input type="file" name="images[]" accept="images/*" class="form-control" multiple>
        
        <br>
        <button class="btn btn-primary" type="submit">Submit</button>  
        
    </form>
@endsection