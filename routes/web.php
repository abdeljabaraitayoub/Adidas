<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
Route::post('/generateResetToken', 'App\Http\Controllers\AuthController@generateResetToken')->name('generateResetToken');
Route::post('/ResetPassword', 'App\Http\Controllers\AuthController@ResetPassword')->name('ResetPassword');

Route::get('/test', 'App\Http\Controllers\AuthController@test')->name('test');
