<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APi\HomeController;
use App\Http\Controllers\APi\UserController;
use App\Http\Controllers\APi\ProductController;
use App\Http\Controllers\APi\BlogController;
use App\Http\Controllers\APi\vnpay\Pay;
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





// Route::get('users', function() {
//     return User::all();
// });
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return auth()->user();
// });

Route::middleware('auth:api')->group(function () {
    // product, blog, comment product, comment blog, account, profile account, seeting, slide, cart, pay
    Route::post('/bill', [Pay::class, 'medium1']);
    Route::post('/orders', [Pay::class, 'ShowOrder']);
});

Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/slides', [HomeController::class, 'index']);
Route::get('/orders', [Pay::class, 'ShowOrder']);


Route::group(['namespace'=>'APi'], function(){
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:api');
});

