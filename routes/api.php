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


Route::middleware([Permission::class])->group(function () {
    //product routes
    Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('read all products');
    Route::get('/products/{product}', 'App\Http\Controllers\ProductController@show')->name('read single products');
    Route::post('/products', 'App\Http\Controllers\ProductController@store')->name('create products');
    Route::put('/products/{product}', 'App\Http\Controllers\ProductController@update')->name('update products');
    Route::delete('/products/{product}', 'App\Http\Controllers\ProductController@destroy')->name('delete products');

    //category routes
    Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('read all categories');
    Route::get('/categories/{category}', 'App\Http\Controllers\CategoryController@show')->name('read single categories');
    Route::post('/categories', 'App\Http\Controllers\CategoryController@store')->name('create categorie');
    Route::put('/categories/{category}', 'App\Http\Controllers\CategoryController@update')->name('update categorie');
    Route::delete('/categories/{category}', 'App\Http\Controllers\CategoryController@destroy')->name('delete categorie');

    //role routes
    Route::get('/roles', 'App\Http\Controllers\RoleController@index')->name('read all roles');
    Route::get('/roles/{role}', 'App\Http\Controllers\RoleController@show')->name('read single roles');
    Route::post('/roles', 'App\Http\Controllers\RoleController@store')->name('create role');
    Route::put('/roles/{role}', 'App\Http\Controllers\RoleController@update')->name('update role');
    Route::delete('/roles/{role}', 'App\Http\Controllers\RoleController@destroy')->name('delete role');

    //permission routes
    Route::get('/permissions', 'App\Http\Controllers\PermissionController@index')->name('read all permissions');
    Route::get('/permissions/{Permission}', 'App\Http\Controllers\PermissionController@show')->name('read single permission');
    Route::post('/permissions', 'App\Http\Controllers\PermissionController@store')->name('create permission');
    Route::put('/permissions/{Permission}', 'App\Http\Controllers\PermissionController@update')->name('update permission');
    Route::delete('/permissions/{Permission}', 'App\Http\Controllers\PermissionController@destroy')->name('delete permission');
});
