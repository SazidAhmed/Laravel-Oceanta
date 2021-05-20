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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/nav', function () {
    return view('layouts.website.navbar');
});
Route::get('/checknew', function () {
    return view('website.checkout');
});
Auth::routes();


Route::get('/dashboard', 'HomeController@index')->name('dashboard');

//Frontend Controllers
Route::get('/','FrontProductListController@index')->name('home');
Route::get('/product/{id}','FrontProductListController@view')->name('product.view');
Route::get('/category/{name}','FrontProductListController@categorisedProduct')->name('product.list');
Route::get('/shop','FrontProductListController@moreProducts')->name('shop');

//Cart Controller
Route::get('/addToCart/{product}','CartController@addToCart')->name('add.cart');
Route::get('/cart','CartController@showCart')->name('cart.show');
//json cartItems
Route::get('/navcart','CartController@showCartInNav');

Route::post('/products/{product}','CartController@updateCart')->name('cart.update');
Route::post('/product/{product}','CartController@removeCart')->name('cart.remove');
//checkout
Route::get('/checkout/{amount}','CartController@checkout')->name('cart.checkout');
//Place Order
Route::post('/placeOrder','CartController@placeOrder')->name('cart.placeOrder');
Route::post('/guestOrder','CartController@guestOrder')->name('cart.guestOrder');
//Customer Panel Order list
Route::get('/customePanel','CartController@customePanel')->name('customePanel')->middleware('auth');
Route::get('/customerInvoice/{userid}/{orderid}','CartController@customerInvoice')->name('customer.invoice')->middleware('auth');

//product Images
Route::get('showImage','ProductimageController@showImage');

//admin panel Controller 
Route::group(['middleware'=>['auth','isAdmin']],function(){
        
        //admin panel Controller 
        Route::resource('users','UserController');
        Route::resource('dashboard','DashboardController');
        Route::resource('category','CategoryController');
        Route::resource('subcategory','SubcategoryController');
        Route::resource('product','ProductController');
        Route::resource('productImage','ProductimageController');
        Route::resource('slider','SliderController');
        Route::get('subcatories/{id}','ProductController@loadSubCategories');

        //orders
        Route::get('allOrder','CartController@allOrder');
        Route::get('/userOrder/{userid}/{orderid}','CartController@viewUserOrder')->name('user.order');
        Route::post('/deleteOrder/{id}','CartController@DeleteOrder')->name('user.orderDelete');
        Route::post('/updateOrder/{id}','CartController@updateOrder')->name('order.update');

        //guest order
        Route::get('allGuestOrder','CartController@allGuestOrder');
        Route::get('/guestOrder/{id}','CartController@viewGuestOrder')->name('guest.order');
        Route::post('/deleteguestOrder/{id}','CartController@DeleteGuestOrder')->name('guest.orderDelete');
        Route::post('/updateGuestOrder/{id}','CartController@updateGuestOrder')->name('guest.orderUpdate');
    });


    Route::resource('review','ReviewController');