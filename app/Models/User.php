<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    //php artisan tinker commands
    // 1. Create User: App\Models\User::factory()->create();
    // 2. Get user: $user = App\Models\User::find(1);
    // 3. Make the order to that user: $order = $user->orders()->save(App\Models\Order::factory()->make());
    // 4. Make the payment to that order: $payment = $order->payment()->save(App\Models\Payment::factory()->make())
    // 5. To retrieve the order that this user has made:  $user->orders;
    // 5. To retrieve the payment that this user has made: $user->payments;
    // 7.
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates
     * 
     * @var array
     */
    protected $dates = [
        'admin_since'
    ];

    public function orders(){
        return $this->hasMany(Order::class, "customer_id");
    }

    public function cart(){
        return $this->hasOne(Cart::class, "customer_id");
    }

    public function payments(){
        //The first param is the targer class, the second param is the mediatery class, the third param is the foreign key that is reffering to the current table from the second param, the fourth param is the foreign key that is referring to the mediatery table from the first param
        return $this->hasManyThrough(Payment::class, Order::class, 'customer_id', 'order_id');
    }

    //One-to-one polymorphic relationship
    public function image(){
        return $this->morphOne(Image::class, 'imageables');
    }

    public function isAdmin(){
        return $this->admin_since != null && $this->admin_since->lessThanOrEqualTo(now());
    }

    //This method will be called when the user->fill() is called
    public function setPasswordAttribute($password){
        //Attributes is referring to the column name
        $this->attributes['password'] = bcrypt($password);
    }

    public function getProfileImageAttribute(){
    //Accessor
    //user->profile_image
        return $this->image ? "images/{$this->image->path}" : 'https://www.gravater.com/avater/404?d=mp';
    }
}
