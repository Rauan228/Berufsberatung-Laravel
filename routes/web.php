<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EventsCalendarController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\InstitutionSpecialtyController;
use App\Http\Controllers\GlobalSpecialtyController;
use App\Http\Controllers\GrantController;


Route::get('/', function () {
    return redirect()->route('login');
});

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



Route::middleware(['auth'])->group(function () {
    Route::resource('applications', ApplicationController::class);
});
Route::post('/applications/{id}/status', [ApplicationController::class, 'updateStatus']);
Route::delete('/applications/{id}', [ApplicationController::class, 'destroy']);
Route::put('/applications/{id}/status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');



Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/{id}/ban', [UserController::class, 'toggleBan'])->name('users.toggleBan');

Route::resource('events', EventsCalendarController::class);
Route::middleware(['auth'])->group(function () {
    Route::resource('events', EventsCalendarController::class);
});

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');



Route::get('/institutions', [InstitutionController::class, 'index'])->name('institutions.index');
Route::get('/institutions/create', [InstitutionController::class, 'create'])->name('institutions.create');
Route::post('/institutions', [InstitutionController::class, 'store'])->name('institutions.store');
Route::get('/institutions/{id}', [InstitutionController::class, 'show'])->name('institutions.show');
Route::get('/institutions/{id}/edit', [InstitutionController::class, 'edit'])->name('institutions.edit');
Route::put('/institutions/{id}', [InstitutionController::class, 'update'])->name('institutions.update');
Route::delete('/institutions/{id}', [InstitutionController::class, 'destroy'])->name('institutions.destroy');


Route::middleware(['auth'])->group(function () {
    Route::get('/likes', [LikeController::class, 'index'])->name('likes.index');
    Route::delete('/likes/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
});

Route::resource('institution_specialties', InstitutionSpecialtyController::class);

Route::resource('global_specialties', GlobalSpecialtyController::class);

Route::resource('grants', GrantController::class);
