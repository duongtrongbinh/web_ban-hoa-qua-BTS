<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/login', function () {return view('account.login');})->name('login');
Route::post('/login', [UserController::class,"login"])->name('actionLogin');
Route::get('/register', function () {return view('account.register');})->name('register');
Route::post('/register', [UserController::class,"register"])->name('actionRegister');

Route::get('/product', function () {return view('pages.product_detail');});


Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/shop/{page?}', [ProductController::class,'index'])->name('shop');
Route::get('/detailproduct/{id}', [ProductController::class,'show'])->name('shop_detail');
Route::get('/cart/{id}/{quantity?}', [ProductController::class,'addToCart'])->name('cart');
Route::get('/carteDcrease/{id}', [ProductController::class,'decrease'])->name('decreaseCart');
Route::get('/mycart', [ProductController::class,'mycart'])->name('mycart');
Route::get('/sumCart', [ProductController::class,'sumCart'])->name('sumCart');
Route::get('/cartss', [ProductController::class,'showCart'])->name('carts');
Route::get('/district/{id}', [ProductController::class,'getDistrict'])->name('district');
Route::get('/warn/{id}', [ProductController::class,'getWarn'])->name('warn');
Route::get('/moneyship/{id}', [ProductController::class,'moneyShip'])->name('moneyship');
Route::get('/removeCart/{id}', [ProductController::class,'removeCart'])->name('removeCart');

Route::get('/404', function () {return view('errors.404');});
Route::get('/cart_login', function () {return view('errors.cart_login');});
Route::get('/cart_null', function () {return view('errors.cart_null');});

Route::get('/my_account', [UserController::class, "showUser"])->name('my_account');

Route::get('my_order', [OrderController::class,'orders'])->name('orders');
Route::get('order_detail/{id}', [OrderController::class,'showOrder']) ->name('detail_order');
Route::post('/order', [ProductController::class,'orderSS'])->name('order');
Route::get('/check', [ProductController::class,'getCheckoutCartProvince'])->name('check');

