<?php

namespace App\Http\Controllers;

use App\Models\EventsCalendar;
use App\Models\UserApplication;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
use Illuminate\Http\Request;
use App\Models\Institution;

class EventsCalendarController extends Controller
{
    public function index(Request $request)
    {
        $query = EventsCalendar::with('institution');

        // Filter by institution type if specified
        if ($request->filled('type')) {
            $query->whereHas('institution', function($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        // Search by name if search term is provided
        if ($request->filled('search')) {
            $query->where('event_name', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(12);
        $admin = Auth::guard('admin')->user();
        
        return view('events_calendar.index', compact('admin', 'events'));
    }

    public function create()
    {
        $institutions = Institution::all();
        $admin = Auth::guard('admin')->user();
        return view('events_calendar.create', compact('admin','institutions'));
    }
    
    

    public function store(Request $request)
{
    $request->validate([
        'institution_id' => 'required|exists:institutions,id',
        'event_name' => 'required|string|max:255',
        'event_date' => 'required|date',
        'description' => 'nullable|string',
    ]);

    EventsCalendar::create([
        'institution_id' => $request->institution_id,
        'event_name' => $request->event_name,
        'event_date' => $request->event_date,
        'description' => $request->description,
    ]);

    return redirect()->route('events.index')->with('success', 'Событие добавлено!');
}


    public function show($id)
    {
        $event = EventsCalendar::with('institution')->findOrFail($id);
        $applications = UserApplication::where('event_id', $id)->with('user')->get();

        return view('events_calendar.about', compact('event', 'applications'));
    }

    public function edit($id)
    {
        $event = EventsCalendar::findOrFail($id);
        $institutions = Institution::all();
        return view('events_calendar.edit', compact('event', 'institutions'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'nullable|string',
        ]);
    
        $event = EventsCalendar::findOrFail($id);
        $event->update([
            'institution_id' => $request->institution_id,
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'description' => $request->description,
        ]);
    
        return redirect()->route('events.index')->with('success', 'Событие обновлено.');
    }
    

    public function destroy($id)
    {
        EventsCalendar::destroy($id);
        return redirect()->route('events.index')->with('success', 'Событие удалено.');
    }
}
