<?php

namespace App\Http\Controllers;

//Import all the models
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Services\CartService;
//Database Transaction
use Illuminate\Support\Facades\DB;

class OrderPaymentController extends Controller
{
    
    //Dependency Injection
    public $cartService;

    public function __construct(CartService $cartService){
        
        $this->cartService = $cartService;
        //THis line is to ensure that the users has logged in before can access to any method here.
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        return view('payments.create')->with(['order' => $order]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    //Store the payment to an existing order
    public function store(Request $request, Order $order)
    {
        //Database transaction is to ensure that all the codes inside this {} are success and if no, no any changes would be made to the database and the error will be thrown
        return DB::transaction(function() use ($order, $request){
            //This line is to detach all the products from the cart
            //If no specified, it will detach all
            // $this->cartService->getFromCookie()->products()->detach();

            //Return the products inside the cart (not the relationship)
            $request->user()->cart->products()->detach();

            //This line of code is to create the payment that is tied for this order
            //call to the relationship to create this order
            $order->payment()->create([
                'amount' => $order->total,
                'payed_at' => now()
            ]);
    
            $order->status = 'paid';
            $order->save();
    
            //The route('route name') can be used for redirecting purpose as well
            return redirect('/')->withSuccess('Thank! We received your payment with RM ' . $order->total);
            //The second param is the maximum number of times that this Database transaction can retry
        },5);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order, Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order, Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, Payment $payment)
    {
        //
    }
}
