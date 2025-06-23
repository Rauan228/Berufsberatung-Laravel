<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EventsCalendar;
use App\Models\Like;
use App\Models\Notification;

class InstitutionEventController extends Controller
{
    // GET /api/institution/events
    public function index()
    {
        $institution = Auth::user();
        if (!$institution) {
            return response()->json(['error' => 'Не авторизован'], 401);
        }
        $events = EventsCalendar::where('institution_id', $institution->id)->orderBy('event_date', 'desc')->get();
        return response()->json($events);
    }

    // POST /api/institution/events
    public function store(Request $request)
    {
        $institution = Auth::user();
        if (!$institution) {
            return response()->json(['error' => 'Не авторизован'], 401);
        }
        $validated = $request->validate([
            'event_name'  => 'required|string|max:255',
            'event_date'  => 'required|date',
            'description' => 'nullable|string',
            'event_type' => 'required|in:open,closed,group',
            'application_schema' => 'nullable',
        ]);
        $validated['institution_id'] = $institution->id;
        $validated['institution_type'] = $institution->type;
        $event = EventsCalendar::create($validated);

        // уведомления пользователям, лайкнувшим это учреждение
        $userIds = Like::where('institution_id', $institution->id)->pluck('user_id')->unique();
        $message = "Университет {$institution->name} опубликовал новое мероприятие \"{$event->event_name}\". Посмотрите детали и запишитесь!";
        foreach($userIds as $uid){
            Notification::create([
                'user_id'=>$uid,
                'event_id'=>$event->id,
                'message'=>$message,
            ]);
        }

        return response()->json($event, 201);
    }

    // PUT /api/institution/events/{id}
    public function update(Request $request, $id)
    {
        $institution = Auth::user();
        if (!$institution) {
            return response()->json(['error' => 'Не авторизован'], 401);
        }
        $event = EventsCalendar::where('institution_id', $institution->id)->findOrFail($id);
        $validated = $request->validate([
            'event_name'  => 'sometimes|string|max:255',
            'event_date'  => 'sometimes|date',
            'description' => 'nullable|string',
            'event_type' => 'sometimes|in:open,closed,group',
            'application_schema' => 'nullable',
        ]);
        $event->update($validated);
        return response()->json($event);
    }

    // DELETE /api/institution/events/{id}
    public function destroy($id)
    {
        $institution = Auth::user();
        if (!$institution) {
            return response()->json(['error' => 'Не авторизован'], 401);
        }
        $event = EventsCalendar::where('institution_id', $institution->id)->findOrFail($id);
        $event->delete();
        return response()->json(['message' => 'deleted']);
    }
} 