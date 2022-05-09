<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Panel;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\PanelProduct;
use App\Rules\CheckSelect;
use App\Http\Requests\ProductRequest;

//Global Scope
use App\Scopes\AvailableScope;

//File System
use Illuminate\Support\Facades\File;


class ProductsController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //The user must login before they can access to any methods of this controller
        $this->middleware('auth');
        
        //This line of code is to let the unauthenticated user to access the index and show
        //$this->middleware('auth')->except(['index', 'show']);

        //This line of code is to let the authenticated user to access the index and show
        //$this->middleware('auth')->only(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //This will return all products as a collection
        //$products = Product::all();

        // //This line will return an Array
        // $products_array = Product::all()->toArray();

        // //This line will return an Json
        // $products_Json = Product::all()->toJson();

        // //This line is to decode the Json to the object class
        // $products_Json = json_decode($products_Json);
       
        //This line of code will call the scopeAvailable() method in the Product.php file
        //get() will return as a collection
        // $products = Product::available()->get();

        //This line will return as an object
        // $product = Product::find($id);

        //This line is to let the Product did not apply the global scope
        // $products = Product::withoutGlobalScope(AvailableScope::class)->get();

        //Since panel product extends Product model, this will return a collection of product as well
        // $products = PanelProduct::all();

        //Since in the panel we only has the list of products without images hence we can write
        $products = PanelProduct::without('images')->get();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        //@csrf token is to check the request is exactly come from your application, in order to prevent hijacking attack from the hacker
        //We must include @csrf under every form

        //The name (e.g: 'productName') here is referred to the name in the input tag
        //If want to use unique, please make sure that the input tag name is same with the column name in the database table
        // $request->validate([
        //     'productName' => 'required | max:10 | unique:tableName',
        //     'productDescription' => 'required | max:1000',
        //     'productPrice' => 'required',
        //     'productStock' => 'required'
        // ]);

        //Custom Validation
        // if ($request->input('productStatus') === 'available' && (int)$request->input('productStock') === 0){
        //     //If session()->put is used, the error will still remaining in the same page if not write session->forget('')
        //     //session()->put('error', 'If available the stock number must greater than 0');
        //     //Alternatively, you can use this line that no forget statement is needed
        //     session()->flash('error', 'If available the stock number must greater than 0');
        //     //The redirect()->back() will refresh the current page
        //     //If you want the old data that you entered previously, add ->withInput(request()->all())
        //     return redirect()->back()->withInput(request()->all());
        // }


        //The name here is referred to the columns name in the database
        $product = PanelProduct::create([
            'title' => $request->input('productName'),
            'description' => $request->input('productDescription'),
            'price' => $request->input('productPrice'),
            'stock' => $request->input('productStock'),
            'status' => $request->input('productStatus'),
        ]);

        // If you dont want to use the upper line
        // $product = Product::create($request->all());

        // // If you use the formRequest
        // $product = Product::create($request->validated(()))

        foreach($request->images as $image){
            $product->images()->create([
                'path' => 'images/' .$image->store('products', 'images'),
            ]);
            
        }
        
        

        //session()->flash('success', 'New product with name '. $product->title . ' has been created');
        return redirect('/panel/products')->withSuccess('New product with name '. $product->title . ' has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    //In order to use implicit model binding, the  name of the variable must be the same with the modal class
    public function show(PanelProduct $product)
    {
        //If you are using modal binding, you dont need to write this line
        // $product = Product::find($id);
        
        return view("products.show", ["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PanelProduct $product)
    {
        //Since we have done the implicit model binding, hence can directly pass the $product
        //$product  = Product::find($id);

        

        return view('products.edit', ['product'=> $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, PanelProduct $product)
    {
        
        if ($request->input('productStatus') === 'available' && (int)$request->input('productStock') === 0){

            session()->flash('error', 'If available the stock number must greater than 0');

            //withInput(request()->all()) will pass back the old data to the forms
            return redirect()->back()->withInput(request()->all())->with(['errors' => "If available the stock number must greater than 0"]);
            // ->withErrors('If available the stock number must greater than 0');
            // 
        }

        $product->update([
            'title' => $request->input('productName'),
            'description' => $request->input('productDescription'),
            'price' => $request->input('productPrice'),
            'stock' => $request->input('productStock'),
            'status' => $request->input('productStatus'),
        ]);
        
        if($request->hasFile('images')){
            foreach($product->images as $image){
                
                //Since we use the seeder before to assign the images and it is not stored into the storage yet, hence we cannot use storage
                //Instead of that, we use file

                $path = storage_path("app/public/{$image->path}");
                
                File::delete($path);
                
                $image->delete();
            }

            foreach($request->images as $image){
                $product->images()->create([
                    'path' => 'images/' . $image->store('products', 'images'),
                ]);
                
            }
        }

        

        // //If you dont want to use the upper line
        // $product->update($request->all());

        //If you use formRequest

        // dd($product);
        // $product->update($request->validated());

        //session()->flash('name', 'description');
        //session()->flash('success', 'Product has been updated successfully');
        return redirect('/panel/products')->withSuccess('Product has been updated successfully');
        // //Or
        // ->with(['name' => "description"])
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PanelProduct $product)
    {
        //Soft Delete
        //Php artisan tinker command:
        // Without Global Scope is to find the unavailable item as well
        // 1. In order to restore all the product that are soft deleted: Product::withoutGlobalScopes()->onlyTrashed()->restore();
        // In order to restore specific product that is soft deleted: Product::withoutGlobalScopes()->onlyTrashed()->find(1)->restore();
        // In order to find the product that is soft deleted: Product::withoutGlobalScopes()->find(1);
        $product->delete();

        return redirect('/panel/products')->withSuccess('Product with id' . $product->id . 'been updated successfully!');
    }
}
