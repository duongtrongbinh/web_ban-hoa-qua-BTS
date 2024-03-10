<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\CategoriesController;
use App\Models\CategoriesModel;
use App\Http\Controllers\CityApi;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\APi\vnpay\Pay;


// use App\Http\Middleware\CheckUser;

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

Route::prefix('/dashboard')->middleware(['auth','check.admin'])->group(function(){

    Route::view('/','dashboard.admin.trangchu')->name('/dashboard');
    // Route::get('/','UserController@list')->name('/dashboard');
    Route::prefix('/product')->group(function (){
        Route::get('', [ProductController::class, 'show'])->middleware('can:list-product')->name('show_list_product');
        Route::get('/list', [ProductController::class, 'index'])->name('list_product');
        Route::get('/export', [ProductController::class, 'fileExport'])->name('export_list_product');
        Route::get('add',[ProductController::class,'create'])->middleware('can:add-product')->name('form_add_product');
        Route::post('add', [ProductController::class, 'store'])->name('add_product');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->middleware('can:edit-product')->name('edit_product');
        Route::put('update', [ProductController::class, 'update'])->name('update_product');
        Route::get('delete/{id}', [ProductController::class, 'destroy'])->middleware('can:delete-product')->name('delete_product');
    });
    Route::prefix('/blog')->group(function (){
        Route::get('/list', [BlogController::class, 'index'])->middleware('can:list-blog')->name('list_blog');
        Route::get('', [BlogController::class, 'show'])->middleware('can:list-blog')->name('show_list_blog');
        Route::get('add',[BlogController::class,'create'])->middleware('can:add-blog')->name('form_add_blog');
        Route::post('add', [BlogController::class, 'store'])->name('add_blog');
        Route::get('edit/{id}', [BlogController::class, 'edit'])->middleware('can:edit-blog')->name('edit_blog');
        Route::put('update/{id}', [BlogController::class, 'update'])->name('update_blog');
        Route::get('delete/{id}', [BlogController::class, 'destroy'])->middleware('can:delete-blog')->name('delete_blog');
    });
    Route::prefix('/setting')->group(function (){
        Route::get('', [SettingController::class, 'index'])->middleware('can:list-setting')->name('list_setting');
        Route::get('edit/{id}', [SettingController::class, 'edit'])->middleware('can:edit-setting')->name('edit_setting');
        Route::put('update', [SettingController::class, 'update'])->name('update_setting');
    });
    Route::prefix('/slide')->group(function (){
        Route::get('', [SlideController::class, 'index'])->middleware('can:list-slide')->name('list_slide');
        Route::get('add',[SlideController::class,'create'])->middleware('can:add-slide')->name('form_add_slide');
        Route::post('add', [SlideController::class, 'store'])->name('add_slide');
        Route::get('edit/{id}', [SlideController::class, 'edit'])->middleware('can:edit-slide')->name('edit_slide');
        Route::put('update/{id}', [SlideController::class, 'update'])->name('update_slide');
        Route::get('delete/{id}', [SlideController::class, 'destroy'])->middleware('can:delete-slide')->name('delete_slide');
    });

    Route::prefix('/categories')->group(function (){
        Route::get('', [CategoriesController::class, 'index'])->middleware('can:list-category')->name('list_categories');


        Route::get('add',[CategoriesController::class,'create'])->middleware('can:add-category')->name('form_add_categories');
        Route::post('add', [CategoriesController::class, 'store'])->name('add_categories');
        Route::get('edit/{id}', [CategoriesController::class, 'edit'])->middleware('can:edit-category')->name('edit_categories');
        Route::put('update', [CategoriesController::class, 'update'])->name('update_categories');
        Route::get('delete/{id}', [CategoriesController::class, 'destroy'])->middleware('can:delete-category')->name('delete_categories');
    });
    Route::prefix('/user')->group(function (){
        Route::get('profile',[UserController::class, 'show'])->name('profileUser');
        Route::put('update/{id}/profile', [UserController::class, 'update'])->name('update_profile');

        Route::get('',[UserController::class, 'index'])->name('list_user');
        Route::get('add',[UserController::class,'create'])->name('form_add_user');
        Route::post('add', [UserController::class, 'store'])->name('add_user');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit_user');
        Route::put('update/{id}', [UserController::class, 'updateRole'])->name('update_user');
        Route::get('delete/{id}', [UserController::class, 'destroy'])->name('delete_user');
    });
    Route::prefix('/order')->group(function (){
    Route::get('/list', [OrderController::class, 'index'])->name('list_order');
    Route::get('/detail/{id}', [OrderController::class, 'show'])->name('detail_order');
    });
    
});
