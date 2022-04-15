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
*/

Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Go to Admin page
|
*/

Route::get('/admin', function () {
    return view('frontend\admin\dashboard');
});

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
    'only' => ['create', 'store', 'edit', 'index', 'show', 'update'],
    'middleware' => ['auth', 'role']
]);
