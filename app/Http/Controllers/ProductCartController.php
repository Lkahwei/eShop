<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Validation\ValidationException;

class ProductCartController extends Controller
{
    //In order to create the nested resources controller, for example we need to implement the function to add the product to the cart
    /*
        1. In the command prompt: php artisan make:controller ProductCartController --parent= The model that we wish to access always (In this case is product) --model = Cart
        2. In the web.php: Route::resource('products.carts', ProductCartController::class)->only(['store', 'destroy']);
    /*
    //Do the dependecy injection
    /*
        1. Use App\Services\CartService;
        2. Declare the variable: public $cartService;
        3. Implement the constructor function:
        public function __construct(CartService $cartService){
            $this->cartService = $cartService
        }
    */
    public $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    //If we declare the type of the variable for example Product $product
    //We are doing the implicit model binding, although we pass only the $product->id, laravel will automatically get the whole details of this product

    public function store(Request $request, Product $product)
    {
        //Since we have inject the dependency above, we can directly use the function inside that services by the current variable
        //$cart = $this->cartService->getFormCookieOrCreate();

        //Get the cart from the user
        $cart = $request->user()->cart;

        //=> is to assign value to the variable, -> is to called the method
        //$cart->products will return the collection (array of the object) (in this case is products)
        //$cart->products() will return the relationship
        //->pivot: This line of code can get the pivot attribute in the pivot table
        // ?? will return first param if not null else return second param
        $quantity = $cart->products->find($product->id)->pivot->quantity ?? 0;

        //Reduce the stock number
        if($product->stock < $quantity + 1){
            throw ValidationException::withMessages([
                'cart' => "There is no enough stock for the quantity you required for {$product->title}",
            ]);
        }

        //The syncWithoutDetaching will continuously update the product quantity with specific product
        //The sync will detach the old product if the new product is added and sync to the database table
        //The attach will continuously attach the product to the database
        //E.g $cart->products()->sync(["X" => ["pivotAttribute" => "value", etc..], "Y" ... etc])

        //$cart->products() : This is mainly used to do the things (call the method) but no to getting the value (collection)
        //$cart->products: This is to get the collection of products
        $cart->products()->syncWithoutDetaching([
            //The name inside the [] is the pivot attributes and it is an array which means it can be [first => value, second =>value, ...etc]
            $product->id => ['quantity' => $quantity + 1]
        ]);

        //This line will update the updated_at attribute if at anytime the cart is updated
        $cart->touch();

        //$cookie = $this->cartService->makeCookie($cart);

        //Return to the last page with cookies
        // return redirect()->back()->cookie($cookie);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    //If you specify the Cart type in the parameter, it will automatically do the implicit model binding which will return the cart
    public function destroy(Product $product, Cart $cart)
    {

        //This line of code is to detach (remove all the related items) the product from the cart products
        $cart->products()->detach($product->id);

        $cart->touch();

        $cookie = $this->cartService->makeCookie($cart);

        // return redirect()->back()->cookie($cookie);
        return redirect()->back();
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function decreaseQuantity(Request $request, Product $product){
        $cart = $request->user()->cart;

        $quantity = $cart->products->find($product->id)->pivot->quantity;

        if($quantity !== 1){
            $cart->products()->syncWithoutDetaching([
                $product->id => ['quantity' => $quantity - 1]
            ]);
    
            
        }
        else{
            $cart->products()->detach($product->id);
        }

        $cart->touch();

        return redirect()->back();
    }
}
