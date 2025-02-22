<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfileController;
use \Illuminate\Routing\RouteRegistrar;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/dashboard', function () {
    return view('admin.auth.dashboard');
});


Route::middleware("auth")->group(function(){
Route::get('/admin/dashboard', [ProfileController::class,'dashboard'])->name('dashboard');
});

Route::get('/admin/register', [AuthController::class,'showRegister'])->name('show.register');

Route::get('/admin/login', [AuthController::class,'showLogin'])->name('show.login');

Route::post('/admin/register', [AuthController::class,'register'])->name('register');

Route::post('/admin/login', [AuthController::class,'login'])->name('login');

Route::post('/admin/logout', [AuthController::class,'logout'])->name('logout');




 
