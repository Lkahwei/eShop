<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Services\CartService;

class CartController extends Controller
{
    
    //Dependency Injection
    public $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //->cart is to get the collection or the object
        //->cart() is to get the relationship
        //But for $request->user() is to get the current user
        $cart = $request->user()->cart;

        // $cart = $this->cartService->getFormCookieOrCreate();

        return view('carts.index')->with(["cart" => $cart]);
    }
}
