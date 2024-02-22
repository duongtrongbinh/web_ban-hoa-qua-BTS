<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APi\HomeController;
use App\Http\Controllers\APi\UserController;
use App\Http\Controllers\APi\ProductController;
use App\Http\Controllers\APi\BlogController;
use App\Models\User;




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





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return auth()->user();
});
Route::middleware('auth:api')->group(function () {
    // product, blog, comment product, comment blog, account, profile account, seeting, slide, cart, pay
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::get('/product/addToCart/{id}/{quantity}', [ProductController::class, 'addCart']);

});

Route::get('users', function() {
    return User::all();
});

Route::group(['namespace'=>'APi'], function(){
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:api');
});

