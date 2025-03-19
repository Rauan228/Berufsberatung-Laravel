<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth

class NotificationController extends Controller
{
    // Просмотр всех уведомлений
    public function index()
{
    $notifications = Notification::with(['user', 'event'])->paginate(20); // Используем eager loading для загрузки связанных данных

    // Получаем текущего вошедшего админа
    $admin = Auth::guard('admin')->user();
    
    return view('notification.index', compact('admin', 'notifications'));
}

    // Добавление нового уведомления
    public function create()
    {
        return view('notification.create');

    }

    // Сохранение нового уведомления
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'nullable|exists:events_calendar,id',
            'message' => 'required|string',
        ]);

        Notification::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'message' => $request->message,
        ]);

        return redirect()->route('notifications.index');
    }

    // Редактирование уведомления
    public function edit(Notification $notification)
    {
        return view('notification.edit', compact('notification'));
    }

    // Обновление уведомления
    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'nullable|exists:events_calendar,id',
            'message' => 'required|string',
        ]);

        $notification->update([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'message' => $request->message,
        ]);

        return redirect()->route('notifications.index');
    }

    // Удаление уведомления
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index');
    }
}
