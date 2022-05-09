<?php

namespace App\Http\Controllers;

use App\Models\Product;

class MainController extends Controller
{

    public function index()
    {
        //If we didn't add the with Eager Loading in the model file, it will not load the relationship at first
        $products = Product::all();

        return view('productHome', ["products" => $products]);
    }
}


?>