<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth

class InstitutionController extends Controller
{
    /**
     * Отображает список всех институтов.
     */
    public function index()
    {
        $institutions = Institution::all();
        $admin = Auth::guard('admin')->user();
        return view('institutions.index', compact('admin','institutions'));
    }

    /**
     * Показывает форму для создания нового института.
     */
    public function create()
    {
        return view('institutions.create');
    }

    /**
     * Сохраняет новый институт в базу данных.
     */
    public function store(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'name' => 'required|string|max:255',
            // При необходимости добавьте валидацию для других полей:
            // 'description' => 'nullable|string',
            // 'location' => 'nullable|string|max:255',
            // 'website' => 'nullable|url|max:255',
        ]);

        Institution::create($request->all());

        return redirect()->route('institutions.index')
                         ->with('success', 'Институт успешно создан.');
    }

    /**
     * Отображает подробную информацию об институте.
     */
    public function show($id)
    {
        $institution = Institution::findOrFail($id);
        return view('institutions.about', compact('institution'));
    }

    /**
     * Показывает форму для редактирования института.
     */
    public function edit($id)
    {
        $institution = Institution::findOrFail($id);
        return view('institutions.edit', compact('institution'));
    }

    /**
     * Обновляет данные института в базе данных.
     */
    public function update(Request $request, $id)
    {
        // Валидация входных данных
        $request->validate([
            'name' => 'required|string|max:255',
            // При необходимости добавьте валидацию для других полей:
            // 'description' => 'nullable|string',
            // 'location' => 'nullable|string|max:255',
            // 'website' => 'nullable|url|max:255',
        ]);

        $institution = Institution::findOrFail($id);
        $institution->update($request->all());

        return redirect()->route('institutions.index')
                         ->with('success', 'Институт успешно обновлен.');
    }

    /**
     * Удаляет институт из базы данных.
     */
    public function destroy($id)
    {
        $institution = Institution::findOrFail($id);
        $institution->delete();

        return redirect()->route('institutions.index')
                         ->with('success', 'Институт успешно удален.');
    }
}
