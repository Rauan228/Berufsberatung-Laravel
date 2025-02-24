<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserApplication;
use App\Models\EventsCalendar;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth

class UserApplicationsController extends Controller
{
    /**
     * Display the user applications index page with filters.
     */
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
        
        return view('applications.user_applications.index', compact('applications','admin', 'events'));
    }
}
