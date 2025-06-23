<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
use App\Models\Institution;
use App\Models\User;
use App\Models\Review;
use App\Models\InstitutionSpecialty;
use App\Models\EventsCalendar;
use App\Traits\AdminCheck;
use Inertia\Inertia;

class HomeController extends Controller
{
    use AdminCheck;

    public function index()
    {
        $this->checkAdmin();
        $institutesCount = Institution::count();
        $universitiesCount = Institution::where('type', 'university')->count();
        $collegesCount = Institution::where('type', 'college')->count();
        $usersCount = User::count();
        $specializationsCount = Specialization::count();
        $latestReview = Review::latest()->with('user')->first();
        $admin = Auth::guard('admin')->user();
        $eventsCount = EventsCalendar::count();
        $events = EventsCalendar::all()->map(function ($event) {
            return [
                'title' => $event->event_name,
                'start' => $event->event_date,
                'description' => $event->description,
            ];
        });

        return view('home', ['events' => $events], 
            compact('eventsCount', 'admin', 'institutesCount', 'universitiesCount', 'collegesCount',
                    'usersCount', 'specializationsCount', 'latestReview', 'events'));
    }
    

    

}
