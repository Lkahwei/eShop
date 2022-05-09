<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //php artisan tinker to create model
    // 1. Command to create 5 payment data: App\Models\Payment::factory(5)->create();
    // 2. Find payment with id = $payment = App\Models\Payment::find(1);
    // With Foregin key defined
    // 1. The order with that id must be save first: App\Models\Order::factory()->create();
    // 2. Create Payment With parameter: App\Models\Payment::factory()->create(['order_id'=>1]);
    // With all fillable: App\Models\Payment::create(['amount'=>200, 'payed_at'=>now(), 'order_id'=>2])

    use HasFactory;

    protected $fillable = ['amount', 'payed_at', 'order_id'];

    /**
     * The attributes that should be mutated to dates
     * 
     * @var array
     */
    protected $dates = [
        'payed_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
