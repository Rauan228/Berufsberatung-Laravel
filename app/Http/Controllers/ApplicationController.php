<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification; // Добавь это для импорта модели Notification


class ApplicationController extends Controller
{
    public function index()
{
    $applications = Application::with(['user', 'event'])->get();
    $admin = Auth::guard('admin')->user();

    return view('applications.index', compact( 'admin','applications'));
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
    $message = ($request->status == 'Pending') ? "Ваша заявка на событие {$application->event->name} была отменена." : 
    "Ваша заявка на событие {$application->event->name} была {$application->status}.";

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
