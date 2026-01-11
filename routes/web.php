<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/admin-login', 'admin-login');
Route::post('/admin-login', [App\Http\Controllers\AdminController::class, 'login']);
Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard']);
