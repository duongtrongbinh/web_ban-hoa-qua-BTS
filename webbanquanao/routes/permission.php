<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Permissions\RoleController;
use App\Http\Controllers\Permissions\PermissionController;



Route::get('/login',[AuthController::class,'index'])->name('form_login');
Route::post('/loginUser',[AuthController::class,'store'])->name('login');

Route::prefix('/dashboard')->group(function(){
    Route::prefix('role')->group(function() {
        Route::get('', [SlideController::class, 'index'])->name('list_slide');
        Route::get('add',[SlideController::class,'create'])->name('form_add_slide');
        Route::post('add', [SlideController::class, 'store'])->name('add_slide');
        Route::get('edit/{id}', [SlideController::class, 'edit'])->name('edit_slide');
        Route::put('update/{id}', [SlideController::class, 'update'])->name('update_slide');
        Route::get('delete/{id}', [SlideController::class, 'destroy'])->name('delete_slide');
    });
});