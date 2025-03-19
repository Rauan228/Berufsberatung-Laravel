<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{ChartController, AuthController, HomeController, UserController, 
    NotificationController, EventsCalendarController, ReviewController, InstitutionController, 
    LikeController, GlobalSpecialtyController, GrantController, SpecializationController, 
    QualificationController, UserApplicationsController,InstitutionApplicationsController};



    Route::get('/', fn() => Inertia::render('MainPage'));



    Route::get('/admin/institutions', [InstitutionController::class, 'index'])->name('institutions.index');
Route::get('/', fn() => Inertia::render('MainPage'));
Route::get('/colleges', fn() => Inertia::render('CollegesListPage'));
Route::get('/events', fn() => Inertia::render('EventsPage'));
Route::get('/map', fn() => Inertia::render('MapPage'));
Route::get('/specialties-col', fn() => Inertia::render('SpecialtiesColListPage'));
Route::get('/specialties-un', fn() => Inertia::render('SpecialtiesUnListPage'));
Route::get('/sum-list', fn() => Inertia::render('SUMListPage'));
Route::get('/test', fn() => Inertia::render('TestPage'));
Route::get('/university-about', fn() => Inertia::render('UniversityAboutPage'));
Route::get('/universities', fn() => Inertia::render('UniversityListPage'));
Route::get('/university-portal', fn() => Inertia::render('UniversityPortalPage'));
Route::get('/user', fn() => Inertia::render('UserPage'));
// Перенаправление на страницу входа при обращении к корневому URL
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', function () {
    return response()->json(['message' => 'Login page']);
});
// Домашняя страница
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Данные для графиков (доступно только аутентифицированным пользователям)
Route::get('/chart-data', [ChartController::class, 'getChartData'])->middleware('auth')->name('chart.data');

// Аутентификация
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Управление уведомлениями
Route::resource('notifications', NotificationController::class);
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');


Route::get('/user_applications', [UserApplicationsController::class, 'index'])->name('applications.user_applications.index');

Route::put('/institutions/{id}', [InstitutionController::class, 'update']);


Route::get('/institution-applications', [InstitutionApplicationsController::class, 'index'])->name('applications.institution_applications.index');
Route::put('/applications/{id}/verify', [InstitutionApplicationsController::class, 'verify'])->name('applications.verify');
Route::put('/institution-applications/{id}/update-verified-status', [InstitutionApplicationsController::class, 'updateVerifiedStatus'])
    ->name('institution-applications.update-verified-status');

// Управление пользователями
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/{id}/ban', [UserController::class, 'toggleBan'])->name('users.toggleBan');

// Управление событиями (календарь событий)
Route::middleware(['auth'])->group(function () {
    Route::resource('events', EventsCalendarController::class);
});

// Управление отзывами
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Управление образовательными учреждениями
Route::resource('institutions', InstitutionController::class);

// Управление лайками (только аутентифицированные пользователи)
Route::middleware(['auth'])->group(function () {
    Route::get('/likes', [LikeController::class, 'index'])->name('likes.index');
    Route::delete('/likes/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
});

// Управление глобальными специальностями
Route::resource('global_specialties', GlobalSpecialtyController::class);

// Управление грантами
Route::resource('grants', GrantController::class);

// Управление специализациями
Route::resource('specializations', SpecializationController::class);

// Управление квалификациями
Route::resource('qualifications', QualificationController::class);






