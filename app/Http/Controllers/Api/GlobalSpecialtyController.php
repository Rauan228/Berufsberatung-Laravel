<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GlobalSpecialty;

class GlobalSpecialtyController extends Controller
{
    // Получить список специальностей
    public function index()
    {
        $globalSpecialties = GlobalSpecialty::all();
        
        return response()->json($globalSpecialties);
    }

    public function getQualificationsWithSpecializations($id)
{
    $specialty = GlobalSpecialty::with('qualifications.specializations')->findOrFail($id);
    return response()->json($specialty);
}


    // Создать новую специальность
    public function store(Request $request)
    {
        $request->validate([
            'specialty_name' => 'required|unique:global_specialties|max:255',
        ]);

        $globalSpecialty = GlobalSpecialty::create($request->all());
        return response()->json($globalSpecialty, 201);
    }

    // Получить детали специальности
    public function show($id)
    {
        $globalSpecialty = GlobalSpecialty::findOrFail($id);
        return response()->json($globalSpecialty);
    }

    // Обновить специальность
    public function update(Request $request, $id)
    {
        $request->validate([
            'specialty_name' => 'required|unique:global_specialties,specialty_name,' . $id . '|max:255',
        ]);

        $globalSpecialty = GlobalSpecialty::findOrFail($id);
        $globalSpecialty->update($request->all());
        return response()->json($globalSpecialty);
    }

    // Удалить специальность
    public function destroy($id)
    {
        GlobalSpecialty::destroy($id);
        return response()->json(null, 204);
    }
}