<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstitutionApplication;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth

class InstitutionApplicationsController extends Controller
{
    /**
     * Display the institution applications index page with filters.
     */
    public function index(Request $request)
    {
        $query = InstitutionApplication::query();
        $admin = Auth::guard('admin')->user();
        
        if ($request->has('verified') && $request->verified != '') {
            $query->where('verified', $request->verified);
        }
        
        $applications = $query->paginate(10);
        
        return view('applications.institution_applications.index', compact('admin','applications'));
    }
}
