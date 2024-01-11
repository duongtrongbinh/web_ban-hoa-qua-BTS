<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CityApi;
use App\Http\Middleware\CheckUser;

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
Route::get('/get-geo-data', [CityApi::class, 'getGeoDataFromAPI']);
Route::get('/login',[UserController::class,'index'])->name('form_login');
Route::post('/loginUser',[UserController::class,'store'])->name('login');
Route::prefix('/dashboard')->group(function(){


    Route::view('/','dashboard.admin.trangchu')->name('/dashboard');

    Route::prefix('/product')->group(function (){
        Route::get('', [ProductController::class, 'index'])->name('list_product');
        Route::get('add',[ProductController::class,'create'])->name('form_add_product');
        Route::post('add', [ProductController::class, 'store'])->name('add_product');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit_product');
        Route::put('update', [ProductController::class, 'update'])->name('update_product');
        Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('delete_product');
    });
    Route::prefix('/blog')->group(function (){
        Route::get('', [BlogController::class, 'index'])->name('list_blog');
        Route::get('add',[BlogController::class,'create'])->name('form_add_blog');
        Route::post('add', [BlogController::class, 'store'])->name('add_blog');
        Route::get('edit/{id}', [BlogController::class, 'edit'])->name('edit_blog');
        Route::put('update', [BlogController::class, 'update'])->name('update_blog');
        Route::get('delete/{id}', [BlogController::class, 'destroy'])->name('delete_blog');
    });
    Route::prefix('/setting')->group(function (){
        Route::get('', [SettingController::class, 'index'])->name('list_setting');
        Route::get('add',[SettingController::class,'create'])->name('form_add_setting');
        Route::post('add', [SettingController::class, 'store'])->name('add_setting');
        Route::get('edit/{id}', [SettingController::class, 'edit'])->name('edit_setting');
        Route::put('update', [SettingController::class, 'update'])->name('update_setting');
        Route::get('delete/{id}', [SettingController::class, 'destroy'])->name('delete_setting');
    });
    Route::prefix('/slide')->group(function (){
        Route::get('', [SlideController::class, 'index'])->name('list_slide');
        Route::get('add',[SlideController::class,'create'])->name('form_add_slide');
        Route::post('add', [SlideController::class, 'store'])->name('add_slide');
        Route::get('edit/{id}', [SlideController::class, 'edit'])->name('edit_slide');
        Route::put('update/{id}', [SlideController::class, 'update'])->name('update_slide');
        Route::get('delete/{id}', [SlideController::class, 'destroy'])->name('delete_slide');
    });
    Route::prefix('/categories')->group(function (){
        Route::get('', [CategoriesController::class, 'index'])->name('list_categories');
        Route::get('add',[CategoriesController::class,'create'])->name('form_add_categories');
        Route::post('add', [CategoriesController::class, 'store'])->name('add_categories');
        Route::get('edit/{id}', [CategoriesController::class, 'edit'])->name('edit_categories');
        Route::put('update', [CategoriesController::class, 'update'])->name('update_categories');
        Route::get('delete/{id}', [CategoriesController::class, 'destroy'])->name('delete_categories');
    });
    Route::prefix('/user')->group(function (){
        // Route::get('', [UserController::class, 'index'])->name('list_user');
        Route::get('add',[UserController::class,'create'])->name('form_add_user');
        Route::post('add', [UserController::class, 'store'])->name('add_user');
        Route::get('edit', [UserController::class, 'edit'])->name('edit_user');
        Route::put('update', [UserController::class, 'update'])->name('update_user');
        Route::get('delete/{id}', [UserController::class, 'destroy'])->name('delete_user');
    });
});
