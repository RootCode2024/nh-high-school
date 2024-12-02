<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PageController::class, 'homePage'])->name('home');



Route::get('/about', [PageController::class, 'aboutPage'])->name('about');
Route::get('/programmes', [PageController::class, 'programmesPage'])->name('programmes');
Route::get('/blog', [PageController::class, 'blogPage'])->name('blog');
Route::get('/contact', [PageController::class, 'contactPage'])->name('contact');



Route::get('/login', [PageController::class, 'login'])->name('login');

