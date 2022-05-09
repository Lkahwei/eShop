@extends('layouts.app')

@section('content')
{{-- 1. label => class name => "form-label" --}}
{{-- 2. input for text, textarea and file => class name => "form-control" --}}
{{-- 3.  input => class name => "form-control-plaintext"--}}
{{-- Can set disabled by including disabled property --}}
{{-- Can set read only by including readonly property --}}
{{-- 4. Set size of input => form-control-lg or form-control-sm --}}
{{-- 5. Input color => type="color" class name ="form-control form-control-color" --}}
{{-- 6. for select , include class name => form-select --}}
{{-- 7. for select label , include class name => form-select-label --}}
{{-- Include the div with class name "form-check" first --}}
{{-- 8. for checkbox, include class name => form-check--}}
{{-- 8. for checkbox label, include class name => form-check-label--}}
{{-- Check box can have two types, whether it is radio or checkbox --}}
{{-- 9. Switch, include one more class name after "form-check" which is "from-switch" --}}
{{-- If want to make all the checkbox on the same line, include one more class name which is form-check-inline for each div --}}

    <h1 class="text-center">Edit Product</h1>
    <form action="{{ route('products.update' , ['product' => $product->id]) }}"  method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="productName" class="form-label">Product Name</label>
        <input type="text" name="productName" id="productName" class="form-control" placeholder="Product Name" value="{{ old('productName') ?? $product->title }}" >
    
        <label for="productDescription" class="form-label">Description</label>
        <input type="text" name="productDescription" id="productDescription" class="form-control" placeholder="Description" value="{{ old('productDescription') ?? $product->description }}" required>
    
        <label for="productPrice" class="form-label">Product Price</label>
        <input type="number" name="productPrice" id="productPrice" class="form-control" placeholder="Product Price" value="{{ old('productPrice') ?? $product->price }}" required>
    
        <label for="productStock" class="form-label">Product Stock</label>
        <input type="number" name="productStock" id="productStock" class="form-control" placeholder="Product Stock" value="{{ old('productStock') ?? $product->stock }}" required>
    
        <label for="productStatus" class="form-label">Product Status</label>
        {{-- <input class="form-control" list="productStatusList" id="productStatus" name="productStatus">
        <datalist id="productStatusList">
            <option value="available" >
            <option value="unavailable" selected>
        </datalist> --}}
        <select name="productStatus" id="productStatus" class="form-select">
            <option value="available" {{ old('productStatus') == 'available' ? 'selected' : ($product->status == 'available' ? 'selected' : '') }} > Available </option>
            <option value="unavailable" {{ old('productStatus') == 'unavailable' ? 'selected' : ($product->status == 'unavailable' ? 'selected' : '') }}> Unavailable </option>
        </select>

        <label for="productStock" class="form-label">{{ __('Images') }}</label>
        <input type="file" name="images[]" accept="images/*" class="form-control" multiple>
        <label class="form-label">Products Image</label>

        <button class="btn-primary" type="submit">Submit</button>
        <button class="btn-danger" type="reset">Reset</button>

        @if (isset($errors) && $errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </div>
        @endif

    </form>
@endsection