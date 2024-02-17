<?php

use Illuminate\Support\Facades\Route;
Route::getRoutes()->refreshNameLookups();
Route::getRoutes()->refreshActionLookups();
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Permissions\RoleController;
use App\Http\Controllers\Permissions\PermissionController;
use App\Http\Controllers\UserController;




Route::get('/login',[AuthController::class,'index'])->name('form_login');
Route::post('/loginUser',[AuthController::class,'store'])->name('login');

Route::prefix('/dashboard')->group(function(){

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