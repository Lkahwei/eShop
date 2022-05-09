<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\AvailableScope;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'customer_id'];

    public function payment(){
        return $this->hasOne(Payment::class);
    }

    public function user(){
        // //If not define, Laravel will default that the foreign key is the name of the function + _id
        // return $this->belongsTo(User::class);

        return $this->belongsTo(User::class, "customer_id");
    }

    public function products(){
        // return $this->belongsToMany(Product::class)->withPivot('quantity');
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
    }

    public function getTotalAttribute(){
        //Since all the products, order, carts consists of getTotalAttribute(), hence we can directly pluck the 'total' from the collection of products
        //->sum() is to sum all, ->avg() is to find the average
        return $this->products()->withoutGlobalScope(AvailableScope::class)->get()->pluck('total')->sum();
    }
}

