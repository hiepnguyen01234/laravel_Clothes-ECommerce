<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| --★ Other way to return view page ★--
| Route::get('/', function () {return view('home');});
|
*/

Route::get('/', 'App\Http\Controllers\DefaultViewController@index');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Go to Admin page
|
| --★ Other way to return view page ★--
| Route::get('/admin', function () {return view('frontend\admin\dashboard');})->middleware('role');
|
*/

Route::get('/admin', 'App\Http\Controllers\DefaultViewController@redirectToAdminPage')->middleware('role');

/*
|--------------------------------------------------------------------------
| Web Authentication Routes
|--------------------------------------------------------------------------
|
| Authentication routes manager
|
*/

Auth::routes();

/*
|--------------------------------------------------------------------------
| Web Authentication Routes
|--------------------------------------------------------------------------
|
| Authentication automatic added route
|
| --★ Note: about "->name()" ★--
| It is other name (reduce name) that can be call in web page.
|
*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Web Product Routes
|--------------------------------------------------------------------------
|
| get view : product
|
| ★Route::resource detail★
| Route::get('product', 'App\Http\Controllers\ProductController@index');
| Route::get('product/create', 'App\Http\Controllers\ProductController@create');
| Route::post('product', 'App\Http\Controllers\ProductController@store');
| Route::get('product/{id}', 'App\Http\Controllers\ProductController@show');
| Route::get('product/{id}/edit', 'App\Http\Controllers\ProductController@edit');
| Route::put('product/{id}', 'App\Http\Controllers\ProductController@update');
| Route::delete('product/{id}', 'App\Http\Controllers\ProductController@destroy');
*/

Route::resource('product', 'App\Http\Controllers\ProductController', [
    'only' => ['create', 'store', 'edit', 'index', 'show', 'update', 'destroy'],
    'middleware' => ['auth', 'role'],

    // --★ Note: Other way ★--
    // Just use "as".
    // Example: Route::resource('product', 'App\Http\Controllers\ProductController', [
    // 'as' => 'product']);
    // It will be convert to route something name like "product.destroy" automatically.
    'names' => [
        'index' => 'product.index',
        'store' => 'product.store',
        'update' => 'product.update',
        'destroy' => 'product.destroy'
    ]
]);

/*
|--------------------------------------------------------------------------
| Web User Routes
|--------------------------------------------------------------------------
|
| get view : user
|
| ★Route::resource detail★
| Route::get('user', 'App\Http\Controllers\UserController@index');
| Route::get('user/create', 'App\Http\Controllers\UserController@create');
| Route::post('user', 'App\Http\Controllers\UserController@store');
| Route::get('user/{id}', 'App\Http\Controllers\UserController@show');
| Route::get('user/{id}/edit', 'App\Http\Controllers\UserController@edit');
| Route::put('user/{id}', 'App\Http\Controllers\UserController@update');
| Route::delete('user/{id}', 'App\Http\Controllers\UserController@destroy');
*/

Route::resource('user', 'App\Http\Controllers\UserController', [
    'only' => ['create', 'store', 'edit', 'index', 'show', 'update', 'destroy'],
    'middleware' => ['auth', 'role']

    // ,'as' => 'user'
    // --★ Note: 'as' => 'user' ★--
    // It had created route name like "user.user.index",
    // and when i deleted it, the route name of default had been made like "user.index".
    // I will try to see how it works. ->It had Worked Fine!
]);
