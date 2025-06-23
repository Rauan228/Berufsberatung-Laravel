<?php

namespace App\Http\Controllers;

use App\Models\CollegeQualification;
use App\Models\CollegeGlobalSpecialty;
use Illuminate\Http\Request;

class CollegeQualificationController extends Controller
{
    public function index()
    {
        $qualifications = CollegeQualification::with(['collegeGlobalSpecialty', 'specializations'])
            ->paginate(12);
        return view('college_qualifications.index', compact('qualifications'));
    }

    public function create()
    {
        $globalSpecialties = CollegeGlobalSpecialty::all();
        return view('college_qualifications.create', compact('globalSpecialties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'qualification_name' => 'required|string|max:255',
            'college_global_specialty_id' => 'required|exists:college_global_specialties,id',
            'description' => 'required|string'
        ]);

        CollegeQualification::create($request->all());
        return redirect()->route('college_qualifications.index')
            ->with('success', 'Квалификация успешно создана');
    }

    public function show($id)
    {
        $qualification = CollegeQualification::with(['collegeGlobalSpecialty', 'specializations'])->findOrFail($id);
        return view('college_qualifications.show', compact('qualification'));
    }

    public function edit($id)
    {
        $qualification = CollegeQualification::findOrFail($id);
        $globalSpecialties = CollegeGlobalSpecialty::all();
        return view('college_qualifications.edit', compact('qualification', 'globalSpecialties'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'qualification_name' => 'required|string|max:255',
            'college_global_specialty_id' => 'required|exists:college_global_specialties,id',
            'description' => 'required|string'
        ]);

        $qualification = CollegeQualification::findOrFail($id);
        $qualification->update($request->all());

        return redirect()->route('college_qualifications.index')
            ->with('success', 'Квалификация успешно обновлена');
    }

    public function destroy($id)
    {
        $qualification = CollegeQualification::findOrFail($id);
        $qualification->delete();

        return redirect()->route('college_qualifications.index')
            ->with('success', 'Квалификация успешно удалена');
    }
} 