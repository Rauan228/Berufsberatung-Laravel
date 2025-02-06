<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;

Route::get('/home', [HomeController::class, 'index'])->name('home');


// Home route, accessible after login
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

// Route for fetching chart data
Route::get('/chart-data', [ChartController::class, 'getChartData'])->middleware('auth')->name('chart.data');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth:admin')->get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('notifications', NotificationController::class);


Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
