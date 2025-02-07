<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
use App\Models\Institution;
use App\Models\User;
use App\Models\Review;
use App\Models\InstitutionSpecialty;
use App\Models\EventsCalendar;

class HomeController extends Controller
{

    public function index()
    {
        $institutesCount = Institution::count();
        $usersCount = User::count();
        $specialtiesCount = InstitutionSpecialty::count();
        $latestReview = Review::latest()->with('user')->first();
        $admin = Auth::guard('admin')->user();
        $events = EventsCalendar::all()->map(function ($event) {
            return [
                'title' => $event->event_name,
                'start' => $event->event_date,
                'description' => $event->description,
            ];
        });

        return view('home', ['events' => $events],compact('admin', 'institutesCount', 'usersCount', 'specialtiesCount', 'latestReview', 'events'));
    }
    

    

}
