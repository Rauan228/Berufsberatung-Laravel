<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\Qualification;

class SpecializationController extends Controller
{
    // Получить список специализаций
    public function index(Request $request)
    {
        $query = Specialization::with('qualification');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('qualification_id') && $request->qualification_id != '') {
            $query->where('qualification_id', $request->qualification_id);
        }

        $specializations = $query->paginate(48);
        return response()->json($specializations);

    }

    // Создать новую специализацию
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'qualification_id' => 'required|exists:qualifications,id',
        ]);

        $specialization = Specialization::create($request->only('name', 'qualification_id'));
        return response()->json($specialization, 201);
    }

    // Получить детали специализации
    public function show($id)
    {
        $specialization = Specialization::with('qualification')->findOrFail($id);
        return response()->json($specialization);
    }

    // Обновить специализацию
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'qualification_id' => 'required|exists:qualifications,id',
        ]);

        $specialization = Specialization::findOrFail($id);
        $specialization->update($request->only('name', 'qualification_id'));
        return response()->json($specialization);
    }

    // Удалить специализацию
    public function destroy($id)
    {
        Specialization::destroy($id);
        return response()->json(null, 204);
    }
}