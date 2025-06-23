<?php

namespace App\Http\Controllers;

use App\Models\CollegeSpecialization;
use App\Models\CollegeQualification;
use Illuminate\Http\Request;

class CollegeSpecializationController extends Controller
{
    public function index()
    {
        $specializations = CollegeSpecialization::with('collegeQualification.collegeGlobalSpecialty')
            ->when(request('search'), function($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })
            ->when(request('college_qualification_id'), function($query) {
                $query->where('college_qualification_id', request('college_qualification_id'));
            })
            ->paginate(12);
        
        $qualifications = CollegeQualification::all();
        
        return view('college_specializations.index', compact('specializations', 'qualifications'));
    }

    public function show($id)
    {
        $specialization = CollegeSpecialization::with('collegeQualification.collegeGlobalSpecialty')->findOrFail($id);
        return view('college_specializations.show', compact('specialization'));
    }

    public function create()
    {
        return view('college_specializations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'college_qualification_id' => 'required|exists:college_qualifications,id'
        ]);

        $specialization = CollegeSpecialization::create($validated);

        return redirect()->route('college_specializations.index')
            ->with('success', 'College specialization created successfully');
    }

    public function edit($id)
    {
        $specialization = CollegeSpecialization::findOrFail($id);
        return view('college_specializations.edit', compact('specialization'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'college_qualification_id' => 'required|exists:college_qualifications,id'
        ]);

        $specialization = CollegeSpecialization::findOrFail($id);
        $specialization->update($validated);

        return redirect()->route('college_specializations.index')
            ->with('success', 'College specialization updated successfully');
    }

    public function destroy($id)
    {
        $specialization = CollegeSpecialization::findOrFail($id);
        $specialization->delete();

        return redirect()->route('college_specializations.index')
            ->with('success', 'College specialization deleted successfully');
    }
} 