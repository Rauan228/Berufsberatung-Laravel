<?php

namespace App\Http\Controllers;

use App\Models\CollegeGlobalSpecialty;
use Illuminate\Http\Request;

class CollegeGlobalSpecialtyController extends Controller
{
    public function index()
    {
        $specialties = CollegeGlobalSpecialty::with('collegeQualifications')
            ->paginate(12);
        return view('college_specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('college_specialties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        CollegeGlobalSpecialty::create($request->all());
        return redirect()->route('college_specialties.index')
            ->with('success', 'Специальность успешно создана');
    }

    public function show($id)
    {
        $specialty = CollegeGlobalSpecialty::with('collegeQualifications.specializations')->findOrFail($id);
        return view('college_specialties.show', compact('specialty'));
    }

    public function edit($id)
    {
        $specialty = CollegeGlobalSpecialty::findOrFail($id);
        return view('college_specialties.edit', compact('specialty'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $specialty = CollegeGlobalSpecialty::findOrFail($id);
        $specialty->update($request->all());

        return redirect()->route('college_specialties.index')
            ->with('success', 'Специальность успешно обновлена');
    }

    public function destroy($id)
    {
        $specialty = CollegeGlobalSpecialty::findOrFail($id);
        $specialty->delete();

        return redirect()->route('college_specialties.index')
            ->with('success', 'Специальность успешно удалена');
    }
} 