@extends('layouts.app')
    {{-- For Container --}}
    {{-- 1. class name => "container" => max-width at each breakpoint --}}
    {{-- 2. "container-fluid" => width 100% at all breakpoint --}}
    {{-- 3. "container-{breakpoint}" => width 100% until it reaches the breakpoint (< 768px for medium )--}}
    {{-- For grid system --}}
    {{-- 1. Define a div with the class name "container" --}}
    {{-- 2. Define another nested div with class name "row" --}}
    {{-- 3. Define each div nested in the second div with the class name "col-*" --}}
    {{-- Class name for row = "row-cols-*" The * means there is how many columns in each row --}}
    {{-- Class name for columns
        Each row is divided into 12 columns, if the addition of columns per row is bigger than 12, the next column will be going to next new row
        1. col => Auto divided based on the content
        2. col-3 => span 3 columns in row
        3. col-sm-3 => within the sm value (>= 576px and < 768px) span 3 columns in row
        4. 6 breakpoints (xs,sm,md,lg,xl,xxl)
        5. col-{breakpoint}-auto => it will estimate the column width that is enough to wrap the content
        6. E.g row-cols-4, if the addition of the column with is greater than 12, it will automatically go to the new row
        --}}

    {{-- alignment in row --}}
@section('content')
    <h1 class="text-center">Product Details</h1>
    <div class="container">
        @include('components.product-card')
    </div>
       


@endsection