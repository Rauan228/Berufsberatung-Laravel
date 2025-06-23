<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\{ChartController, AuthController, HomeController, UserController, 
    NotificationController, EventsCalendarController, ReviewController, InstitutionController, 
    LikeController, GlobalSpecialtyController, GrantController, SpecializationController, 
    QualificationController, UserApplicationsController, InstitutionApplicationsController,
    CollegeSpecializationController, CollegeGlobalSpecialtyController, CollegeQualificationController};

Route::get('/', function() {
    return redirect('/home');
});
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

// Аутентификация
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:admin');

// Админские маршруты
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/home', function () {
        $institutesCount = \App\Models\Institution::count();
        $universitiesCount = \App\Models\Institution::where('type', 'university')->count();
        $collegesCount = \App\Models\Institution::where('type', 'college')->count();
        $usersCount = \App\Models\User::count();
        $eventsCount = \App\Models\EventsCalendar::count();
        $specialtiesCount = \App\Models\GlobalSpecialty::count() + \App\Models\CollegeGlobalSpecialty::count();
        $specializationsCount = \App\Models\Specialization::count() + \App\Models\CollegeSpecialization::count();
        $latestReview = \App\Models\Review::with('user')->latest()->first();
        $events = \App\Models\EventsCalendar::all()->map(function($e){
            return [
                'title' => $e->event_name,
                'start' => \Carbon\Carbon::parse($e->event_date)->format('Y-m-d'),
            ];
        })->values();
        
        return view('home', compact(
            'institutesCount',
            'universitiesCount',
            'collegesCount',
            'usersCount',
            'eventsCount',
            'specialtiesCount',
            'specializationsCount',
            'latestReview',
            'events'
        ));
    })->name('home');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    
    // Остальные админские маршруты...
    Route::resource('notifications', NotificationController::class);
    Route::resource('events', EventsCalendarController::class);
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::resource('institutions', InstitutionController::class);
    Route::get('/likes', [LikeController::class, 'index'])->name('likes.index');
    Route::delete('/likes/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
    Route::prefix('specialties')->group(function () {
        Route::get('/', [GlobalSpecialtyController::class, 'index'])->name('specialties.index');
        Route::get('/create', [GlobalSpecialtyController::class, 'create'])->name('specialties.create');
        Route::post('/', [GlobalSpecialtyController::class, 'store'])->name('specialties.store');
        Route::get('/{id}', [GlobalSpecialtyController::class, 'show'])->name('specialties.show');
        Route::get('/{id}/edit', [GlobalSpecialtyController::class, 'edit'])->name('specialties.edit');
        Route::put('/{id}', [GlobalSpecialtyController::class, 'update'])->name('specialties.update');
        Route::delete('/{id}', [GlobalSpecialtyController::class, 'destroy'])->name('specialties.destroy');
    });
    Route::prefix('college-specializations')->group(function () {
        Route::get('/', [CollegeSpecializationController::class, 'index'])->name('college_specializations.index');
        Route::get('/create', [CollegeSpecializationController::class, 'create'])->name('college_specializations.create');
        Route::post('/', [CollegeSpecializationController::class, 'store'])->name('college_specializations.store');
        Route::get('/{id}', [CollegeSpecializationController::class, 'show'])->name('college_specializations.show');
        Route::get('/{id}/edit', [CollegeSpecializationController::class, 'edit'])->name('college_specializations.edit');
        Route::put('/{id}', [CollegeSpecializationController::class, 'update'])->name('college_specializations.update');
        Route::delete('/{id}', [CollegeSpecializationController::class, 'destroy'])->name('college_specializations.destroy');
    });
    Route::resource('grants', GrantController::class);
    Route::resource('specializations', SpecializationController::class);
    Route::resource('qualifications', QualificationController::class);
    Route::prefix('college-qualifications')->group(function () {
        Route::get('/', [CollegeQualificationController::class, 'index'])->name('college_qualifications.index');
        Route::get('/create', [CollegeQualificationController::class, 'create'])->name('college_qualifications.create');
        Route::post('/', [CollegeQualificationController::class, 'store'])->name('college_qualifications.store');
        Route::get('/{id}', [CollegeQualificationController::class, 'show'])->name('college_qualifications.show');
        Route::get('/{id}/edit', [CollegeQualificationController::class, 'edit'])->name('college_qualifications.edit');
        Route::put('/{id}', [CollegeQualificationController::class, 'update'])->name('college_qualifications.update');
        Route::delete('/{id}', [CollegeQualificationController::class, 'destroy'])->name('college_qualifications.destroy');
    });
    Route::get('/chart-data', [ChartController::class, 'getChartData'])->name('chart.data');
    Route::get('/test-chart-data', [ChartController::class, 'getTestResultChartData'])->name('test.chart.data');
});

// Остальные маршруты
Route::get('/user_applications', [UserApplicationsController::class, 'index'])->name('applications.user_applications.index');
Route::put('/institutions/{id}', [InstitutionController::class, 'update']);
Route::get('/institution-applications', [InstitutionApplicationsController::class, 'index'])->name('applications.institution_applications.index');
Route::put('/applications/{id}/verify', [InstitutionApplicationsController::class, 'verify'])->name('applications.verify');
Route::put('/institution-applications/{id}/update-verified-status', [InstitutionApplicationsController::class, 'updateVerifiedStatus'])
    ->name('institution-applications.update-verified-status');

Route::prefix('college-specialties')->group(function () {
    Route::get('/', [CollegeGlobalSpecialtyController::class, 'index'])->name('college_specialties.index');
    Route::get('/create', [CollegeGlobalSpecialtyController::class, 'create'])->name('college_specialties.create');
    Route::post('/', [CollegeGlobalSpecialtyController::class, 'store'])->name('college_specialties.store');
    Route::get('/{id}', [CollegeGlobalSpecialtyController::class, 'show'])->name('college_specialties.show');
    Route::get('/{id}/edit', [CollegeGlobalSpecialtyController::class, 'edit'])->name('college_specialties.edit');
    Route::put('/{id}', [CollegeGlobalSpecialtyController::class, 'update'])->name('college_specialties.update');
    Route::delete('/{id}', [CollegeGlobalSpecialtyController::class, 'destroy'])->name('college_specialties.destroy');
});






