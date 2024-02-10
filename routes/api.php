<?php

use App\Http\Middleware\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth routes
Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
Route::post('/generateResetToken', 'App\Http\Controllers\AuthController@generateResetToken')->name('generateResetToken');
Route::post('/ResetPassword', 'App\Http\Controllers\AuthController@ResetPassword')->name('ResetPassword');
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');

//product routes
Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('read all products');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name('read single products');
Route::post('/products', 'App\Http\Controllers\ProductController@store')->name('create products');
Route::put('/products/{id}', 'App\Http\Controllers\ProductController@update')->name('update products');
Route::delete('/products/{id}', 'App\Http\Controllers\ProductController@destroy')->name('delete products');

Route::middleware([Permission::class])->group(function () {



    Route::get('/test', 'App\Http\Controllers\AuthController@test')->name('test');
});
