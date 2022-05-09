<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id'];

    //Php artisan tinker command
    // 1. Create cart => App\Models\cart::factory->create();
    // 2. find Cart => $cart = App\Models\Cart::find(1);
    // 3. Many to many relationship data assignment => $cart->products()->attach([1 => ['quantity' => 5], 2 => ['quantity' => 3]]);
    // 4. The above statement will insert data into the cart_product table
    // The 1 is referred to the product id, inside the [], all of the arguments written in the withPivot() must be defined
    // 4. To verify that the all products has been assigned => $cart->products
    // 5. Want to access different product quantity => $cart->products()->first()->pivot->quantity;

    public function products(){
        // //Without many-to-many polymorphic
        // return $this->belongsToMany(Product::class)->withPivot('quantity');
        // //With many-to-many polymorphic
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
    }

    //Accessor
    //The function name should be getNameAttribute
    // Whenever in the context, for example product
    // You call the $product->total, this method will be executed and return the value
    public function getTotalAttribute(){
        return $this->products->pluck('total')->sum();
    }

    public function getTotalProductAttribute(){
        return $this->products->pluck('pivot.quantity')->sum();
    }

    public function user(){
        return $this->belongsTo(User::class, "customer_id");
    }

    
}
