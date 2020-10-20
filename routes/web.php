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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', 'App\Http\Controllers\HomeController@index');
Route::get('/home/{id}', 'App\Http\Controllers\HomeController@show');
Route::post('/home/add', 'App\Http\Controllers\HomeController@add');
Route::get('/car/removeAll', 'App\Http\Controllers\CarController@removeAll');

Route::resource('/users', 'App\Http\Controllers\UserController');
Route::resource('/car', 'App\Http\Controllers\CarController');
Route::resource('/roles', 'App\Http\Controllers\RoleController');
Route::resource('/products', 'App\Http\Controllers\ProductController');

Auth::routes();
