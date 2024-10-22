<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('login', [DashboardController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [DashboardController::class, 'login'])->name('login.store');
Route::get('register', [DashboardController::class, 'showSignUpForm'])->name('register')->middleware('guest');
Route::post('register', [DashboardController::class, 'register'])->name('register.store');

// Protected Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('show/single', [DashboardController::class, 'showSingle'])->name('show.single');
    Route::get('show/bulk', [DashboardController::class, 'showBulk'])->name('show.bulk');
    Route::post('bulk', [DashboardController::class, 'bulk'])->name('bulk');
    Route::post('create', [DashboardController::class, 'create'])->name('books.single');
    Route::post('logout', [DashboardController::class, 'logout'])->name('logout');
});
