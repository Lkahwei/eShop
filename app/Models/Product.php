<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\AvailableScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    
    use HasFactory, SoftDeletes;

    //Fillable means those can be inserted with values and it must be same with the database / migration
    protected $fillable = ['title', 'description', 'price', 'stock', 'status'];

    //Eager Loading
    //Eager Loading means load all the product images into the products at the very first time and dont need to do the n+1 query at the end which save a lot of bandwidth
    //referring to the table name associated in the relationship
    protected $with = [
        'images', //function names
    ];
    
    protected $table = 'products';

    /**
     * The "booted" method of the model.
     *
     * @return void
     */

    //The global scope will be applied to every single query of the Product and return back only the available products
    protected static function booted()
    {
        //For every time we are running any queries of Products, this global scope will be running
        static::addGlobalScope(new AvailableScope);

        //This will be called after the product was updated by any actions
        static::updated(function($product){
            if($product->stock == 0 && $product->status == 'available'){
                $product->status = 'unavailable';

                //save to the database
                $product->save();
            }
        });
    }

    public function carts(){
        // No polymorphic version
        //->withPivot('') will define what is the attributes that we want to get from the pivot table
        // return $this->belongsToMany(Cart::class)->withPivot('quantity');

        // // Many-to-many polymorphic relationship
        // Multiple products can belong to multiple carts and multiple orders at the same time
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity');
    }

    public function orders(){
        // return $this->belongsToMany(Order::class)->withPivot('quantity');
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');
    }

    //One-to-many polymorphic relationship
    public function images(){
        return $this->morphMany(Image::class, 'imageables');
    }

    //In order to create global scope
    // 1. Create this local scope first
    // 2. Create the NameScope.php in the Scopes folder
    // 3. Implements all the required methods, such as apply(Builder $builder, Model $model)
    // 4. implements the booted method in the model file
    //Local Scope
    //just put the name after scope"PopularYourself" in order to call it, for example Product::available()

    public function scopeAvailable($query){
        return $query->where('status', '=', 'available');
    }

    //Accessor
    public function getTotalAttribute(){
        //Why use $this, this is because we are in the current context
        //This will be called if we used $product->total;
        return $this->price * $this->pivot->quantity;
    }

}
