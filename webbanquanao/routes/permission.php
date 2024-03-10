<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Permissions\RoleController;
use App\Http\Controllers\Permissions\PermissionController;
use App\Http\Controllers\UserController;




Route::get('/',[AuthController::class,'index'])->name('form_login');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::post('/loginUser',[AuthController::class,'store'])->name('login');

Route::prefix('/per')->middleware(['auth',"check.admin"])->group(function(){

    Route::prefix('role')->group(function() {
        Route::get('addPer',[RoleController::class,'createPer'])->name('form_add_permiison');
        Route::post('addPer', [RoleController::class, 'storePer'])->name('add_permiison');

        Route::get('', [RoleController::class, 'index'])->name('list_role');
        Route::get('add',[RoleController::class,'create'])->name('form_add_role');
        Route::post('add', [RoleController::class, 'store'])->name('add_role');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('edit_role');
        Route::put('update/{id}', [RoleController::class, 'update'])->name('update_role');
        Route::get('delete/{id}', [RoleController::class, 'destroy'])->name('delete_role');
    });

});