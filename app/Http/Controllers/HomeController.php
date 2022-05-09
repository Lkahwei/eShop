<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Ensure the user must login before they can access to any method here
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //::all() and ->get() will return a collection
        //::where('attributeName in the database', '=', 'value')->get();
        $products = Product::all();
        return view('home', ['products' => $products]);
    }
}
