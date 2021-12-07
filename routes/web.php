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

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    //Categories
    Route::get('categories/{categories}', 'HomeController@categoryName')->name('home.categories');

    //Brands
    Route::get('brands/{brands}', 'HomeController@brandName')->name('home.brands');

    //Compare
    Route::get("compare", 'CompareController@index');


    //Cart
    Route::post('cart/add', 'ProductsController@addToCart')->name('cart.add');
    Route::post('cart/delete', 'ProductsController@deleteCart')->name('cart.delete');

    //Checkout
    Route::get(
        'checkout',
        'TransactionsController@checkoutIndex'
    )->name('checkout');
    Route::post('checkout/req', 'TransactionsController@store')->name('checkout.store');

    //Transactions
    Route::get('transactions', 'TransactionsController@index')->name('transactions.home');
    Route::get('transactions/{id}', 'TransactionsController@detail')->name('transactions.detail');

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */
    Route::middleware("can:isAdmin")->group(function () {
        //Users
        Route::get('admin/staff', 'UsersController@index')->name('users.admin');
        Route::get('admin/staff/create', 'UsersController@create')->name('admin.users.create');

        Route::delete('admin/staff/delete/{id}', 'UsersController@destroy')->name('users.delete');

        Route::post('admin/staff/reset/{id}', 'UsersController@resetPassword')->name('users.reset');
        Route::post('admin/staff/store', 'UsersController@store')->name('admin.users.store');
    });



    /*
    |--------------------------------------------------------------------------
    | Staff
    |--------------------------------------------------------------------------
    */
    Route::middleware("can:isStaff")->group(function () {
        //Home
        Route::get("admin", 'HomeController@adminIndex')->middleware('can:isStaff');

        //Brand
        Route::get("admin/brands", 'BrandsController@adminIndex')->name("brands.admin");
        Route::get("admin/brands/create", 'BrandsController@create')->name("brands.create");
        Route::get("admin/brands/edit/{brands}", 'BrandsController@edit')->name("brands.edit");

        Route::post("admin/brands/store", 'BrandsController@store')->name('brands.store');
        Route::put("admin/brands/update/{brands}", 'BrandsController@update')->name('brands.update');

        Route::delete("admin/brands/delete/{brands}", 'BrandsController@destroy')->name("brands.delete");

        //Categories
        Route::get("admin/categories", 'CategoriesController@adminIndex')->name("categories.admin");
        Route::get("admin/categories/create", 'CategoriesController@create')->name("categories.create");
        Route::get("admin/categories/edit/{categories}", 'CategoriesController@edit')->name("categories.edit");

        Route::post("admin/categories/store", 'CategoriesController@store')->name('categories.store');
        Route::put("admin/categories/update/{categories}", 'CategoriesController@update')->name('categories.update');

        Route::delete("admin/categories/delete/{categories}", 'CategoriesController@destroy')->name("categories.delete");


        //Products
        Route::get('admin/products/create', 'ProductsController@create')->name('products.create');
        Route::get('admin/products', 'ProductsController@index')->name('products.admin');
        Route::get("admin/products/edit/{products}", 'ProductsController@edit')->name("products.edit");

        Route::post("admin/products/store", 'ProductsController@store')->name('products.store');
        Route::put("admin/products/update/{products}", 'ProductsController@update')->name('products.update');

        Route::delete("admin/products/delete/{products}", 'ProductsController@destroy')->name("brands.products");


        //Transactions

        Route::get('admin/transactions', 'TransactionsController@adminIndex')->name('transactions.admin');
        Route::get('admin/transactions/{id}', 'TransactionsController@adminDetail')->name('transactions.admin.detail');

        Route::post('admin/transactions/confirm', 'TransactionsController@confirmTransaction')->name('transactions.confirm');
    });
});


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get("products/{slug}", 'ProductsController@detail');

//API
Route::post("api/products/search", 'SearchController@searchProduct')->name('api.products.search');
