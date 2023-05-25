<?php

use App\Http\Controllers\Auth\admin\LoginAdminController;
use App\Http\Controllers\Auth\admin\ProfileAdminController;
use App\Http\Controllers\Auth\admin\RegisterAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController as AuthProfileController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/login', [LoginController::class, 'create'])->name(('auth.view.login'));
Route::post('/login', [LoginController::class, 'store'])->name(('auth.login'));
Route::get('/logout', [LoginController::class, 'destroy'])->name(('auth.logout'));
Route::get('/register', [RegisterController::class, 'create'])->name(('auth.view.register'));
Route::post('register', [RegisterController::class, 'store'])->name('auth.register');
Route::get('profile', [AuthProfileController::class, 'view'])->name('auth.profile');
Route::post('profile', [AuthProfileController::class, 'message'])->name('auth.post.message');
Route::post('edit/profile = {infor_id} {user_id}', [AuthProfileController::class, 'edit'])->name('auth.edit.profile');
Route::post('createProfile =  {user_id}', [AuthProfileController::class, 'create'])->name('auth.create.profile');

// route admin login/register/profile
Route::prefix('admin')->group(function(){
    Route::get('register', [RegisterAdminController::class, 'create']);
    Route::post('register', [RegisterAdminController::class, 'store'])->name('admin.register');
    Route::get('login', [LoginAdminController::class, 'create'])->name('admin.view.login');
    Route::post('login', [LoginAdminController::class, 'store'])->name('admin.login');
    Route::get('logout', [LoginAdminController::class,'destroy'])->name('admin.logout');
});

