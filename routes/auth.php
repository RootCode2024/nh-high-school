<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('loginPost');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/password-request', [AuthController::class, 'passwordRequest'])->name('password.request');
