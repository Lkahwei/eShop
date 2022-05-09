<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
//Model Input
use App\Models\Order;
//Custom Request
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
//Dependency Injection on Service
use App\Services\CartService;
//Database Transaction
use Illuminate\Support\Facades\DB;



class OrderController extends Controller
{
    //Dependency Injection
    public $cartService;

    public function __construct(CartService $cartService){
        
        $this->cartService = $cartService;
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $cart = $this->cartService->getFromCookie();

        $cart = $request->user()->cart;
        
        if(!isset($cart) || $cart->products->isEmpty()){
            //redirect()->back() will reload the current pages
            return redirect()->back()->withErrors('Your Cart is Empty');
        }

        return view('orders.create')->with(['cart' => $cart]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // In order to get the current user
        // First Version
        //$user = Auth::user();

        //Second Version
        //$user = $request->user();

        //Database transaction is used to ensure the data consistency in the database
        //If any operation under this transaction fails, no data will be commited, else if success for all operations, all the data changed is commited
        //This first return what is in the closure return
        //use(param) let the param can be used inside the {}
        return DB::transaction(function() use($request){
            $user = $request->user();
    
            //If we want to create the order that is related to this user, we must call the relationship using $user->orders() and call the ->create() method with all the fillable attributes except the foreign key
            $order = $user->orders()->create([
                //fillable attributes
               'status' => 'pending'
            ]);
    
            // $cart = $this->cartService->getFromCookie();
            $cart = $user->cart;
    
            //mapWithKeys is to loop through the products (hence it is to loop the collection) and create a map
            $cartProductsWithQuantity = $cart->products->mapWithKeys(function ($product){
                //The quantity for each product inside the cart
                //->is referring to the pivot table for $product
                //->quantity is the attribute in the pivot table
                $quantity = $product->pivot->quantity;

                if($product->stock < $quantity){
                    throw ValidationException::withMessages([
                        //If want to use {} and pass the variable inside, must use double quotes
                        'cart' => "There is no enough stock for the quantity you required of {$product->title}",
                    ]);
                }

                //Decrement is the method in Eloquent that used to decrease the number of first param which is same as the column name with the second parameter
                $product->decrement('stock', $quantity);

                // [] is the array and and pass in multiple attributes of the pivot table as many
                $element[$product->id] = ['quantity' => $product->pivot->quantity];
    
                return $element;
            });
    
    
            //Attach whole product
            $order->products()->attach($cartProductsWithQuantity->toArray());
    
            //Return to route name orders.payments.create with item passed
            return redirect()->route('orders.payments.create', ['order' => $order->id]);
        },5);
    }
}
