<?php

use App\Http\Controllers\Api\GlobalSpecialtyController;
use App\Http\Controllers\Api\QualificationController;
use App\Http\Controllers\Api\SpecializationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InstitutionController;
use App\Http\Controllers\Api\UserAuthController;

Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/institutions', [InstitutionController::class, 'index']);
Route::get('/institutions/{id}', [InstitutionController::class, 'show']);

Route::get('/global-specialitiez', [GlobalSpecialtyController::class, 'index']);

Route::get('/qualifications', [QualificationController::class, 'index']);   
Route::get('/global-specialties/{id}/qualifications', [GlobalSpecialtyController::class, 'getQualificationsWithSpecializations']);

Route::get('/specilizations', [SpecializationController::class, 'index']);  

Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');


