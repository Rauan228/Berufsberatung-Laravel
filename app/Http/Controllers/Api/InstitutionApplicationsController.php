<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstitutionApplication;
use Illuminate\Support\Facades\Auth;

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
        
        $applications = $query->paginate(16);
        
        return view('applications.institution_applications.index', compact('admin', 'applications'));
    }

    /**
     * Update the verified status of an institution application.
     */
    public function updateVerifiedStatus(Request $request, $id)
    {
        $application = InstitutionApplication::findOrFail($id);
        $application->verified = $request->verified;
        $application->save();

        return redirect()->back()->with('success', 'Verified status updated successfully.');
    }
}