<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\EventsCalendar;


class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with(['user', 'event']);
    
        // Фильтр по событию
        if ($request->has('event_id') && $request->event_id != '') {
            $query->where('event_id', $request->event_id);
        }
    
        // Сортировка по статусу
        if ($request->has('status') && in_array($request->status, ['Pending', 'Accepted', 'Rejected'])) {
            $query->where('status', $request->status);
        }
    
        $applications = $query->paginate(20)->appends([
            'event_id' => $request->event_id,
            'status' => $request->status,
        ]);
        
        $admin = Auth::guard('admin')->user();
        $events = EventsCalendar::all(); // Загружаем список событий
    
        return view('applications.index', compact('admin', 'applications', 'events'));
    }
    

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected', // Статусы с учетом правильных регистров
        ]);

        $application = Application::findOrFail($id);

        // Обновляем статус заявки
        $application->status = $request->status;
        $application->save();

        // Создаем уведомление для пользователя
        $message = ($request->status == 'Pending') ? "Your event request {$application->event->name} was canceled." :
            "Your event request {$application->event->name} was {$application->status}.";

        Notification::create([
            'user_id' => $application->user_id, // Пользователь заявки
            'event_id' => $application->event_id, // Событие заявки
            'message' => $message, // Сообщение
        ]);

        return redirect()->route('applications.index'); // Перенаправляем назад
    }



    public function destroy($id)
    {
        Application::destroy($id);
        return response()->json(['success' => true]);
    }
}
