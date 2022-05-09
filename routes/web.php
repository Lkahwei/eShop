<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::resource('/products', ProductsController::class);

Route::get('/', 'MainController@index')->name('name');

Route::get('profile', 'ProfileController@edit')->name('profile.edit');

Route::put('profile', 'ProfileController@update')->name('profile.update');

Route::post('products/{product}', 'ProductCartController@decreaseQuantity')->name('products.decreaseQuantity');

Route::resource('products.carts', ProductCartController::class)->only(['store', 'destroy']);

//Use only create and store method inside this controller
 //This line of code is to let only the autenticated user to access the index and show method
// ->only(['index', 'show']);
//and middleware(['verified']) will make sure that the user is a verified user
//->name('name') is the name of the route
Route::resource('orders.payments', OrderPaymentController::class)->only(['create', 'store'])->middleware(['verified']);

Route::resource('carts', CartController::class)->only(['index']);

Route::resource('orders', OrderController::class)->only(['create', 'store'])->middleware(['verified']);


Auth::routes([
    //This verify is set to true means the verified method can be used
    //$this->redirectPath() means redirect to the current path
    'verify' => true,
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//In order to disable the login, logout and etc, just rename the true for if statements in the AuthRouteMethods.php to false.
//MAIL_FROM_ADDRESS -> it is defined on what is the sender name
//MAIL_MAILER -> display the email in the log if the value is log
