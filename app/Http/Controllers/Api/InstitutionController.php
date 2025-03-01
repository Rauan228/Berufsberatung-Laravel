<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution;

class InstitutionController extends Controller
{
    // Получить список институтов
       // Получить список институтов
    public function index()
    {
        $institutions = Institution::whereNotIn('verified', ['pending', 'rejected'])
            ->withCount('reviews') // Добавляем количество отзывов
            ->withAvg('reviews', 'rating') // Добавляем средний рейтинг
            ->paginate(100);

        return response()->json($institutions);
    }

    // Создать новый институт
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:institutions,name',
            'email' => 'required|email|max:255|unique:institutions,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $institution = Institution::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'verified' => 'pending',
        ]);

        return response()->json($institution, 201);
    }

    // Получить детали института
    public function show($id)
{
    try {
        $institution = Institution::with(['specializations.qualification', 'specializations' => function ($query) {
            $query->withPivot('cost', 'duration');
        }])->findOrFail($id);

        return response()->json($institution);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Institution not found'], 404);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}


    // Обновить институт
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $institution = Institution::findOrFail($id);
        $institution->update($request->all());
        return response()->json($institution);
    }

    // Удалить институт
    public function destroy($id)
    {
        Institution::destroy($id);
        return response()->json(null, 204);
    }
}