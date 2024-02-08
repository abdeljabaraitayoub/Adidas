<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
Route::post('/generateResetToken', 'App\Http\Controllers\AuthController@generateResetToken')->name('generateResetToken');
Route::post('/ResetPassword', 'App\Http\Controllers\AuthController@ResetPassword')->name('ResetPassword');

Route::get('/test', 'App\Http\Controllers\AuthController@test')->name('test');
