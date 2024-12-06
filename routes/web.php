<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

//Website Pages
Route::get('/', [PageController::class, 'homePage'])->name('home');
Route::get('/about', [PageController::class, 'aboutPage'])->name('about');
Route::get('/programmes', [PageController::class, 'programmesPage'])->name('programmes');
Route::get('/blog', [PageController::class, 'blogPage'])->name('blog');
Route::get('/contact', [PageController::class, 'contactPage'])->name('contact');


//Student Pages
Route::prefix('student/')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('student.dashboard');
    Route::get('profile', [DashboardController::class, 'profile'])->name('student.profile');
});

// Route::fallback([PageController::class, 'notFound']);

Route::get('/settings', [PageController::class, 'settingsPage'])->name('settings');
Route::get('/notifications', [PageController::class, 'settingsPage'])->name('notifications');

require __DIR__.'/auth.php';