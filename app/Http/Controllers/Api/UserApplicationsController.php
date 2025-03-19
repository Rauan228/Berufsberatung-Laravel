<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserApplication;
use App\Models\EventsCalendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserApplicationsController extends Controller
{
    /**
     * Store a new user application for an event.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Начало обработки запроса store', ['request' => $request->all()]);
            
            $request->validate([
                'event_id' => 'required|exists:events_calendar,id',
            ]);

            $userId = Auth::id();
            Log::info('Получение user_id', ['user_id' => $userId]);
            
            if (!$userId) {
                Log::warning('Пользователь не аутентифицирован');
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $existingApplication = UserApplication::where('user_id', $userId)
                ->where('event_id', $request->event_id)
                ->first();

            if ($existingApplication) {
                Log::info('Заявка уже существует', ['application' => $existingApplication]);
                return response()->json(['message' => 'Вы уже подали заявку на это событие'], 409);
            }

            $application = UserApplication::create([
                'user_id' => $userId,
                'event_id' => $request->event_id,
                'status' => 'Pending',
            ]);

            Log::info('Заявка успешно создана', ['application' => $application]);
            return response()->json($application, 201);
        } catch (\Exception $e) {
            Log::error('Ошибка при создании заявки: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return response()->json(['message' => 'Внутренняя ошибка сервера', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get the current user's applications with event details.
     */
    public function getUserApplications()
    {
        try {
            $userId = Auth::id();
            if (!$userId) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $applications = UserApplication::where('user_id', $userId)
                ->with(['event.institution']) // Загружаем событие и связанный институт
                ->get();

            return response()->json($applications);
        } catch (\Exception $e) {
            Log::error('Ошибка при получении заявок пользователя: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Внутренняя ошибка сервера', 'error' => $e->getMessage()], 500);
        }
    }

    public function index(Request $request)
    {
        $query = UserApplication::with(['user', 'event']);
        $admin = Auth::guard('admin')->user();
        
        if ($request->has('event_id') && $request->event_id != '') {
            $query->where('event_id', $request->event_id);
        }
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        $applications = $query->paginate(20);
        $events = EventsCalendar::all();
        
        return view('applications.user_applications.index', compact('applications', 'admin', 'events'));
    }
}