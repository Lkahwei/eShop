<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

//Since we have repeating code in order to get the "Cart" cookie, we can write the service and inject this dependency into the controller file whic needs this function
class CartService
{
    protected $cookieName;
    protected $cookieExpiration;

    public function __construct(){
        $this->cookieName = config('cart.cookie.name');
        $this->cookieExpiration = config('cart.cookie.expiration');
    }

    public function getFromCookie(){
        $cartId = Cookie::get($this->cookieName);

        return Cart::find($cartId);
    }
    public function getFormCookieOrCreate()
    {
        $cart = $this->getFromCookie();

        
        return $cart ?? Cart::create();
    }

    public function makeCookie(Cart $cart){
        //Update again the cookie
        return $cookie = Cookie::make($this->cookieName, $cart->id, $this->cookieExpiration);
    }

    public function countProducts(){
        $cart = $this->getFromCookie();

        //Because we attach the quantity as [$product->id => ['quantity' => $quantity + 1]]
        if($cart !== null){
            //must be plucked from the collection
            return $cart->products->pluck('pivot.quantity')->sum();
        }

        return 0;
    }
}
?>