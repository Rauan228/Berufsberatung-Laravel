<?php

namespace App\Http\Controllers;

use App\Models\GlobalSpecialty;
use App\Models\CollegeGlobalSpecialty;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
use Illuminate\Http\Request;

class GlobalSpecialtyController extends Controller
{
    /**
     * Отобразить список всех глобальных специальностей.
     */
    public function index()
    {
        $type = request()->query('type', 'all');

        if ($type === 'university') {
            $universitySpecialties = GlobalSpecialty::with('qualifications.specializations')->get();
            $collegeSpecialties = collect(); // Empty collection
        } elseif ($type === 'college') {
            $universitySpecialties = collect(); // Empty collection
            $collegeSpecialties = CollegeGlobalSpecialty::with('collegeQualifications.specializations')->get();
        } else {
            $universitySpecialties = GlobalSpecialty::with('qualifications.specializations')->get();
            $collegeSpecialties = CollegeGlobalSpecialty::with('collegeQualifications.specializations')->get();
        }

        return view('specialties.index', compact('universitySpecialties', 'collegeSpecialties'));
    }

    public function show($id, Request $request)
    {
        $type = $request->query('type', 'university');
        
        if ($type === 'university') {
            $specialty = GlobalSpecialty::with('qualifications.specializations')->findOrFail($id);
            return view('specialties.show', ['specialty' => $specialty, 'type' => 'university']);
        } else {
            $specialty = CollegeGlobalSpecialty::with('collegeQualifications.specializations')->findOrFail($id);
            return view('specialties.show', ['specialty' => $specialty, 'type' => 'college']);
        }
    }

    /**
     * Показать форму для создания новой специальности.
     */
    public function create()
    {
        return view('specialties.create');
    }

    /**
     * Сохранить новую специальность в базе данных.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:university,college'
        ]);

        if ($validated['type'] === 'university') {
            GlobalSpecialty::create([
                'name' => $validated['name'],
                'description' => $validated['description']
            ]);
        } else {
            CollegeGlobalSpecialty::create([
                'name' => $validated['name'],
                'description' => $validated['description']
            ]);
        }

        return redirect()->route('specialties.index')->with('success', 'Specialty created successfully');
    }

    /**
     * Показать форму редактирования существующей специальности.
     */
    public function edit($id, Request $request)
    {
        $type = $request->query('type', 'university');
        
        if ($type === 'university') {
            $specialty = GlobalSpecialty::findOrFail($id);
        } else {
            $specialty = CollegeGlobalSpecialty::findOrFail($id);
        }

        return view('specialties.edit', compact('specialty', 'type'));
    }

    /**
     * Обновить данные существующей специальности.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:university,college'
        ]);

        if ($validated['type'] === 'university') {
            $specialty = GlobalSpecialty::findOrFail($id);
        } else {
            $specialty = CollegeGlobalSpecialty::findOrFail($id);
        }

        $specialty->update([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        return redirect()->route('specialties.index')->with('success', 'Specialty updated successfully');
    }

    /**
     * Удалить специальность.
     */
    public function destroy($id, Request $request)
    {
        $type = $request->query('type', 'university');
        
        if ($type === 'university') {
            $specialty = GlobalSpecialty::findOrFail($id);
        } else {
            $specialty = CollegeGlobalSpecialty::findOrFail($id);
        }

        $specialty->delete();

        return redirect()->route('specialties.index')->with('success', 'Specialty deleted successfully');
    }
}
