<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    // Получить список уведомлений
    public function index()
    {
        $notifications = Notification::with(['user', 'event'])->paginate(20);
        return response()->json($notifications);
    }

    // Создать новое уведомление
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'nullable|exists:events_calendar,id',
            'message' => 'required|string',
        ]);

        $notification = Notification::create($request->all());
        return response()->json($notification, 201);
    }

    // Получить детали уведомления
    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        return response()->json($notification);
    }

    // Обновить уведомление
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'nullable|exists:events_calendar,id',
            'message' => 'required|string',
        ]);

        $notification = Notification::findOrFail($id);
        $notification->update($request->all());
        return response()->json($notification);
    }

    // Удалить уведомление
    public function destroy($id)
    {
        Notification::destroy($id);
        return response()->json(null, 204);
    }
}