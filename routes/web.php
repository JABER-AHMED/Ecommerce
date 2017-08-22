<?php

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

Route::get('/', [

		'uses' => 'FrontEndController@index',
		'as' => 'index'
]);

Route::get('/product/{id}', 'FrontEndController@SingleProduct')->name('product.single');

Auth::routes();

Route::get('products/index', 'ProductsController@index')->name('product.index');
Route::get('products/create', 'ProductsController@create')->name('product.create');
Route::post('products/store', 'ProductsController@store')->name('product.store');
Route::get('products/edit\{id}', 'ProductsController@edit')->name('product.edit');
Route::post('products/update\{id}', 'ProductsController@update')->name('product.update');
Route::get('products/delete\{id}', 'ProductsController@delete')->name('product.delete');

//shopping cart

Route::post('/cart/add', 'ShoppingController@add_cart')->name('cart.add');
Route::get('/cart', 'ShoppingController@cart')->name('cart');
Route::get('/cart/delete/{id}', 'ShoppingController@delete')->name('cart.delete');
Route::get('/cart/incr/{id}/{qty}', 'ShoppingController@incr')->name('cart.incr');
Route::get('/cart/decr/{id}/{qty}', 'ShoppingController@decr')->name('cart.decr');
Route::get('/cart/rapid/add/{id}', 'ShoppingController@repid_add_cart')->name('rapid.add_cart');

//checkout
Route::get('/checkout', 'CheckoutController@checkout')->name('cart.checkout');
Route::post('/checkout', 'CheckoutController@pay')->name('cart.checkout');

Route::get('/home', 'HomeController@index')->name('home');
