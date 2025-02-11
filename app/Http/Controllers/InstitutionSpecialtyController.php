<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
use App\Models\InstitutionSpecialty;
use App\Models\Institution;
use App\Models\GlobalSpecialty;

class InstitutionSpecialtyController extends Controller
{
    public function index()
    {
        $specialties = InstitutionSpecialty::with(['institution', 'specialty'])->get();
        $admin = Auth::guard('admin')->user();
        return view('institution_specialties.index', compact('admin','specialties'));
    }

    public function create()
    {
        $institutions = Institution::all();
        $globalSpecialties = GlobalSpecialty::all();
        return view('institution_specialties.create', compact('institutions', 'globalSpecialties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => 'required',
            'specialty_id' => 'required',
            'specialty_name' => 'required'
        ]);

        InstitutionSpecialty::create($request->all());
        return redirect()->route('institution_specialties.index')->with('success', 'Specialty added successfully');
    }

    public function edit(InstitutionSpecialty $institutionSpecialty)
    {
        $institutions = Institution::all();
        $globalSpecialties = GlobalSpecialty::all();
        return view('institution_specialties.edit', compact('institutionSpecialty', 'institutions', 'globalSpecialties'));
    }

    public function update(Request $request, InstitutionSpecialty $institutionSpecialty)
    {
        $request->validate([
            'institution_id' => 'required',
            'specialty_id' => 'required',
            'specialty_name' => 'required'
        ]);

        $institutionSpecialty->update($request->all());
        return redirect()->route('institution_specialties.index')->with('success', 'Specialty updated successfully');
    }

    public function destroy(InstitutionSpecialty $institutionSpecialty)
    {
        $institutionSpecialty->delete();
        return redirect()->route('institution_specialties.index')->with('success', 'Specialty deleted successfully');
    }
}