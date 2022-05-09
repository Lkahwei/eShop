<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Image;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // **if you use create(), dont need to write save() in order to save to the database, else if you use make(), need to write save() at the end
        
        //The first line is to create 20 users and save to the database
        //The second line is to loop through the $users variable which has 20 users
        //The third line is to assign the image that is associated to the user
        //The fourth line is to save the image
        $users = User::factory(20)->create()
                ->each(function($user) {
                $image = Image::factory()->user()->make();
                $user->image()->save($image);
                $cart = Cart::factory()->make();
                $cart->customer_id = $user->id;
                $cart->save();
        });

        $orders = Order::factory(10)->make()
                //The use keyword will use the $variable
                ->each(function($order) use ($users){
                    $order->customer_id = $users->random()->id;
                    $order->save();

                    $payment = Payment::factory()->make();
                    // // First version
                    // $payment->order_id = $order->id;
                    // $payment->save();

                    // // Second version
                    // This version can automatically recognize the relationship between the order and the payment (One-to-one) and save to the database
                    $order->payment()->save($payment);
                });


                

        $products = Product::factory(50)->create()
                    ->each(function ($product) use ($orders, $users){
                        //Get random order from the $orders
                        $order = $orders->random();

                        // For many-to-many, remember to use attach([foreign_key => ['pivot table variable' => respective value]]);
                        $order->products()->attach([
                            $product->id => ['quantity' => mt_rand(1,3)]
                        ]);

                        $cart = $users->random()->cart;

                        $cart->products()->attach([
                            $product->id => ['quantity' => mt_rand(1,3)]
                        ]);

                        $images = Image::factory(mt_rand(2,4))->make();
                        $product->images()->saveMany($images);
                    });
    }
}
