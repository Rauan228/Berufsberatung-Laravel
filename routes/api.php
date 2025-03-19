<?php

use App\Http\Controllers\Api\GlobalSpecialtyController;
use App\Http\Controllers\Api\QualificationController;
use App\Http\Controllers\Api\SpecializationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InstitutionController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\EventsCalendarController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\UserApplicationsController; // Обновлено

Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/institutions', [InstitutionController::class, 'index']);
Route::get('/institutions/{id}', [InstitutionController::class, 'show']);
Route::post('/institutions/register', [InstitutionController::class, 'register']);
Route::get('/global-specialitiez', [GlobalSpecialtyController::class, 'index']);

Route::get('/qualifications', [QualificationController::class, 'index']);   
Route::get('/global-specialties/{id}/qualifications', [GlobalSpecialtyController::class, 'getQualificationsWithSpecializations']);

Route::get('/specilizations', [SpecializationController::class, 'index']);  
Route::get('/specializations', [SpecializationController::class, 'index']);

Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/user-login', [UserAuthController::class, 'login']);
Route::post('/user-logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/current-user', [UserController::class, 'getCurrentUser']);
Route::middleware('auth:sanctum')->get('/liked-institutions', [InstitutionController::class, 'getLikedInstitutions']);
Route::delete('/institutions/{id}/unlike', [InstitutionController::class, 'unlike'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/current-user', function (Request $request) {
    return response()->json($request->user());
});
Route::middleware('auth:sanctum')->post('/institutions/{id}/like', [InstitutionController::class, 'like']);

Route::middleware('auth:sanctum')->get('/notifications', [NotificationController::class, 'getUserNotifications']);

// Получить список всех событий
Route::get('/events', [EventsCalendarController::class, 'index']);

// Получить события по ID университета
Route::get('/institutions/{institutionId}/events', [EventsCalendarController::class, 'getEventsByInstitution']);
Route::get('/institutions/{id}/reviews', [InstitutionController::class, 'getReviews']);
Route::middleware('auth:sanctum')->post('/institutions/{id}/reviews', [InstitutionController::class, 'storeReview']);
Route::post('/institutions/login', [InstitutionController::class, 'login']);
Route::middleware('auth:sanctum')->get('/institutions/current', [InstitutionController::class, 'getCurrentInstitution']);

// Получить детали события по ID
Route::get('/events/{id}', [EventsCalendarController::class, 'show']);

// Создать новое событие
Route::post('/events', [EventsCalendarController::class, 'store']);

// Обновить событие по ID
Route::put('/events/{id}', [EventsCalendarController::class, 'update']);

// Удалить событие по ID
Route::delete('/events/{id}', [EventsCalendarController::class, 'destroy']);

Route::delete('/institutions/{id}/unlike', [InstitutionController::class, 'unlike'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user-applications', [UserApplicationsController::class, 'store']);
    Route::get('/user-applications', [UserApplicationsController::class, 'getUserApplications']);
    Route::get('/user-reviews', [UserController::class, 'getUserReviews']); // Новый маршрут для отзывов
});