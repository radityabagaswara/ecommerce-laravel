<?php

use Illuminate\Support\Facades\Auth;
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
//     return view('index');
// });
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get("products/{slug}", 'ProductsController@detail');

Route::get("compare", 'CompareController@index');

//Admin
Route::get("admin", 'HomeController@adminIndex')->middleware('can:isStaff');


//Brand
Route::get("admin/brands", 'BrandsController@adminIndex')->name("brands.admin");
Route::get("admin/brands/create", 'BrandsController@create')->name("brands.create");
Route::get("admin/brands/edit/{brands}", 'BrandsController@edit')->name("brands.edit");

Route::post("admin/brands/store", 'BrandsController@store')->name('brands.store');
Route::put("admin/brands/update/{brands}", 'BrandsController@update')->name('brands.update');
Route::delete("admin/brands/delete/{brands}", 'BrandsController@destroy')->name("brands.delete");


Route::get('brands/{brands}', 'HomeController@brandName')->name('home.brands');


//Categories
Route::get("admin/categories", 'CategoriesController@adminIndex')->name("categories.admin");
Route::get("admin/categories/create", 'CategoriesController@create')->name("categories.create");
Route::get("admin/categories/edit/{categories}", 'CategoriesController@edit')->name("categories.edit");

Route::post("admin/categories/store", 'CategoriesController@store')->name('categories.store');
Route::put("admin/categories/update/{categories}", 'CategoriesController@update')->name('categories.update');

Route::delete("admin/categories/delete/{categories}", 'CategoriesController@destroy')->name("categories.delete");


Route::get('categories/{categories}', 'HomeController@categoryName')->name('home.categories');


//Products
Route::get('admin/products/create', 'ProductsController@create')->name('products.create');
Route::get('admin/products', 'ProductsController@index')->name('products.admin');
Route::get("admin/products/edit/{products}", 'ProductsController@edit')->name("products.edit");

Route::post("admin/products/store", 'ProductsController@store')->name('products.store');
Route::put("admin/products/update/{products}", 'ProductsController@update')->name('products.update');
Route::delete("admin/products/delete/{products}", 'ProductsController@destroy')->name("brands.products");



Route::post('admin/products/store', 'ProductsController@store')->name('products.store');


//Cart
Route::post('cart/add', 'ProductsController@addToCart')->name('cart.add');
Route::post('cart/delete', 'ProductsController@deleteCart')->name('cart.delete');

//Checkout
Route::get('checkout', 'TransactionsController@checkoutIndex')->name('checkout');
Route::post('checkout/req', 'TransactionsController@store')->name('checkout.store');


//Transactions
Route::get('admin/transactions', 'TransactionsController@adminIndex')->name('transactions.admin');
Route::get('admin/transactions/{id}', 'TransactionsController@adminDetail')->name('transactions.admin.detail');

Route::post('admin/transactions.confirm', 'TransactionsController@confirmTransaction')->name('transactions.confirm');



//API
Route::post("api/products/search", 'SearchController@searchProduct')->name('api.products.search');
