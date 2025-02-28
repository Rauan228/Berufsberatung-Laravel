<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grant;
use App\Models\Institution;

class GrantController extends Controller
{
    // Получить список грантов
    public function index()
    {
        $grants = Grant::with('institution')->paginate(12);
        return response()->json($grants);
    }

    // Создать новый грант
    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'grant_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'application_deadline' => 'required|date',
        ]);

        $grant = Grant::create($request->all());
        return response()->json($grant, 201);
    }

    // Получить детали гранта
    public function show($id)
    {
        $grant = Grant::with('institution')->findOrFail($id);
        return response()->json($grant);
    }

    // Обновить грант
    public function update(Request $request, $id)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'grant_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'application_deadline' => 'required|date',
        ]);

        $grant = Grant::findOrFail($id);
        $grant->update($request->all());
        return response()->json($grant);
    }

    // Удалить грант
    public function destroy($id)
    {
        Grant::destroy($id);
        return response()->json(null, 204);
    }
}