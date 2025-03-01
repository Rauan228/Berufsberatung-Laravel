<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Models\GlobalSpecialty;

class QualificationController extends Controller
{
    // Получить список квалификаций
    public function index(Request $request)
    {
        $query = Qualification::with(['globalSpecialty', 'specializations']); // Загружаем связанные данные
    
        if ($request->has('specialty_id') && $request->specialty_id != '') {
            $query->where('specialty_id', $request->specialty_id);
        }
    
        $qualifications = $query->get();
        return response()->json($qualifications);
    }

    // Создать новую квалификацию
    public function store(Request $request)
    {
        $request->validate([
            'qualification_name' => 'required|string|max:255',
            'specialty_id' => 'required|exists:global_specialties,id',
        ]);

        $qualification = Qualification::create([
            'qualification_name' => $request->qualification_name,
            'specialty_id' => $request->specialty_id,
        ]);

        return response()->json($qualification, 201);
    }

    // Получить детали конкретной квалификации
    public function show($id)
    {
        $qualification = Qualification::with('globalSpecialty')->findOrFail($id);
        return response()->json($qualification);
    }

    // Обновить квалификацию
    public function update(Request $request, $id)
    {
        $request->validate([
            'qualification_name' => 'required|string|max:255',
            'specialty_id' => 'required|exists:global_specialties,id',
        ]);

        $qualification = Qualification::findOrFail($id);
        $qualification->update([
            'qualification_name' => $request->qualification_name,
            'specialty_id' => $request->specialty_id,
        ]);

        return response()->json($qualification);
    }

    // Удалить квалификацию
    public function destroy($id)
    {
        Qualification::destroy($id);
        return response()->json(null, 204);
    }
}