<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventsCalendar;
use App\Models\Institution;

class EventsCalendarController extends Controller
{
    // Получить список событий
    public function index()
{
    $events = EventsCalendar::with('institution')->paginate(12);
    return response()->json($events);
}

    // Создать новое событие
    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $event = EventsCalendar::create($request->all());
        return response()->json($event, 201);
    }

    // Получить события по ID университета
    public function getEventsByInstitution($institutionId)
    {
        $events = EventsCalendar::where('institution_id', $institutionId)->get();
        return response()->json($events);
    }

    // Получить детали события
    public function show($id)
    {
        $event = EventsCalendar::with('institution')->findOrFail($id);
        return response()->json($event);
    }

    // Обновить событие
    public function update(Request $request, $id)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $event = EventsCalendar::findOrFail($id);
        $event->update($request->all());
        return response()->json($event);
    }

    // Удалить событие
    public function destroy($id)
    {
        EventsCalendar::destroy($id);
        return response()->json(null, 204);
    }
}