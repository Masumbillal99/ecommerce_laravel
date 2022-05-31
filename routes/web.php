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

Route::get('/', 'FrontendController@index');
Route::get('/contact', 'FrontendController@contact');
Route::get('/about', 'FrontendController@about');
Route::get('/product/details/{product_id}', 'FrontendController@productdetails');
Route::get('/shop', 'FrontendController@shop');


Auth::routes(['verify' => true]); //login, register, forget password

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');;


#categoryController route
Route::get('/add/category', 'CategoryController@addcategory');

Route::post('/add/category/post', 'CategoryController@addcategorypost');

Route::get('/update/category/{category_id}', 'CategoryController@updatecategory');

Route::post('/update/category/post', 'CategoryController@updatecategorypost');

Route::get('/delete/category/{category_id}', 'CategoryController@deletecategory');

Route::get('/restore/category/{category_id}', 'CategoryController@restorecategory');

Route::get('/harddelete/category/{category_id}', 'CategoryController@harddeletecategory');


#profileController route
Route::get('/profile', 'profileController@index');
Route::post('/profile/post', 'profileController@profilepost');
Route::post('/password/post', 'profileController@passwordpost');

#productController route
Route::get('/add/product', 'ProductController@addproduct');
Route::post('/add/product/post', 'ProductController@addproductpost');
// Route::post('/password/post', 'profileController@passwordpost');

#CartController route
Route::get('/cart', 'CartController@cart');
Route::get('/cart/{coupon_name}', 'CartController@cart');
Route::post('/add/to/cart', 'CartController@addtocart');
Route::get('/cart/delete/{cart_id}', 'CartController@cartdelete');
Route::post('/cart/update', 'CartController@cartupdate');

#CouponController route
Route::get('/add/coupon', 'CouponController@addcoupon');
Route::post('/add/coupon/post', 'CouponController@addcouponpost');
// Route::get('/cart/{coupon}', 'CouponController@addcouponpost');

#CheckoutController route
Route::get('/checkout', 'CheckoutController@index');
Route::post('/checkout/post', 'CheckoutController@checkoutpost');

#Customer_registerController route
Route::get('/customer/register', 'Customer_registerController@customerregister');
Route::post('/customer/register/post', 'Customer_registerController@customerregisterpost');


