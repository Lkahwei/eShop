@if (isset($cart))
<div class="card p-3">
    {{-- The asset will refer to the public folder with the path --}}
    <div class="card-body h-100 w-100">
        <div class="card-header text-uppercase fs-6 fw-bold">{{ $product->title }}</div>
        <div id="productImages{{ $product->id }}" class="carousel slide" >
            <div class="carousel-inner">
                @foreach($product->images as $image)
                {{-- The $loop can get the detail of the current loop --}}
                    <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
                        {{-- The asset will refer to the public folder --}}
                        <img class="card-img-top" src="{{ asset($image->path) }}"  alt="">
                    </div>
                @endforeach
            </div>
       

            {{-- Next and previous icon in carousel --}}
            {{-- The hash will directly go to the #carousel id as defined on the top --}}
            {{-- <a href="#carousel{{ $product->id }}" role="button" class="carousel-control-prev" data-bs-target= "productImages" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>

            <a href="#carousel{{ $product->id }}" role="button" class="carousel-control-next" data-bs-target= "productImages" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a> --}}
            <button class="carousel-control-prev" type="button" data-bs-target="#productImages{{ $product->id }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productImages{{ $product->id }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <p class="card-text py-3">Description: {{ $product->description }}</p>
        <p class="card-text">Item Price: RM{{ number_format((float)$product->price, 2) }}</p>
        {{-- In order to get the pivot attributes from the pivot table, you must write $product->pivot->the attribute name --}}
        <div class="container card-text py-3">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-8 my-auto">
                    Quantity: 
                </div>
                <div class="col-sm-2 col-1 m-auto">
                    <form class="d-inline" action="{{ route('products.decreaseQuantity', ['product' => $product->id])}}" method="POST">
                        @csrf
                        <button class="btn btn-outline-primary" type="submit">-</button>
                    </form>
                </div>
                <div class="col-sm-3 col-2 m-auto">
                    <div class="card-text text-center">{{ $product->pivot->quantity }}</div>
                </div>
                <div class="col-sm-2 col-1 m-auto">
                    <form action="{{ route('products.carts.store', ['product' => $product->id]) }}" method="POST">
                    @csrf
                        <button class="btn btn-outline-primary" type="submit">+</button>
                    </form> 
                </div>
            </div>
        </div> 

        <p class="card-text">Sub Total: RM {{ number_format((float)$product->total, 2) }}</p>
            
        {{-- In order to pass the variable to the route, we must write route('name', ['name' => value]) --}}
        <form class="w-100" action="{{ route('products.carts.destroy', ['product' => $product->id, 'cart' => $cart->id])}}" method="POST">
        @csrf
        @method('DELETE')
            <button class="btn btn-warning w-50" type="submit">Delete from cart</button>
        </form>
    </div>
</div>
@else
    <div class="card">
        <div class="card-body position-relative h-100 w-100">
            <div id="productImages{{ $product->id }}" class="carousel slide" >
                <div class="carousel-inner">
                    @foreach($product->images as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
                            <div class="d-block mb-3">
                                <img class="card-img-top w-100" height="150" src="{{ asset($image->path) }}"  alt="">
                            </div>
                            
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productImages{{ $product->id }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#productImages{{ $product->id }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="card-text text-center text-uppercase d-block ">
                <div class="fw-bold fs-5"  style="height: 100px; width:auto;">
                    <p class="p-2">{{ $product->title }}</p>
                </div>
                
                <p class="fw-bolder fs-6 p-2">RM {{ number_format($product->price,2) }}</p>
                <p class="text-muted text-end p-2 mb-3">Stock Available: {{ $product->stock }}</p>
            </div>
            {{-- <p class="card-title text-center fw-bold fs-5 text-uppercase p-2">{{ $product->title }}</p> --}}
            {{-- <p class="card-text">Description: {{ $product->description }}</p> --}}
            {{--<p class="card-text text-center fw-bolder fs-6 p-2">RM {{ number_format($product->price,2) }}</p> --}}
            {{--<p class="card-text p-2">Stock Available: {{ $product->stock }}</p> --}}
            {{-- <p class="card-text">Status: {{ $product->status }}</p> --}}
            <form class="card-text w-100 " action="{{ route('products.carts.store', ['product' => $product->id]) }}" method="POST">
            @csrf
                <button class="btn btn-success w-100 text-uppercase" type="submit">Add to Cart</button>
            </form>
        </div>
    </div>
@endif