<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\InstitutionApplication; // Добавляем импорт модели InstitutionApplication
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // ✅ Добавляем импорт DB
use Illuminate\Support\Facades\Hash; // ✅ Добавляем импорт Hash

class InstitutionController extends Controller
{
    /**
     * Отображает список всех институтов.
     */
    public function index()
    {
        $institutions = Institution::whereNotIn('verified', ['pending', 'rejected'])->paginate(12);
        $admin = Auth::guard('admin')->user();
        return view('institutions.index', compact('admin', 'institutions'));
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
        $request->validate([
            'name' => 'required|string|max:255|unique:institutions,name',
            'email' => 'required|email|max:255|unique:institution_applications,email',
            'password' => 'required|string|min:6|confirmed', // 'confirmed' проверяет повтор пароля
        ]);

        DB::transaction(function () use ($request) {
            // Создаем университет
            $institution = Institution::create([
                'name' => $request->name,
                'email' => $request->email,
                'verified' => 'pending', // Пока заявка не одобрена
            ]);

            // Создаем заявку
            InstitutionApplication::create([
                'institution_id' => $institution->id,
                'institution_name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'verified' => 'pending',
            ]);
        });

        return redirect()->route('institutions.index')->with('success', 'Заявка на создание университета отправлена.');
    }

    /**
     * Отображает подробную информацию об институте.
     */
    public function show($id)
    {
        $institution = Institution::with(['specializations.qualification', 'specializations' => function ($query) {
            $query->withPivot('cost', 'duration');
        }])->findOrFail($id);

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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $institution = Institution::findOrFail($id);
        $institution->update($request->all());

        return redirect()->route('institutions.index')->with('success', 'Институт успешно обновлен.');
    }

    /**
     * Удаляет институт из базы данных.
     */
    public function destroy($id)
    {
        $institution = Institution::findOrFail($id);
        $institution->delete();

        return redirect()->route('institutions.index')->with('success', 'Институт успешно удален.');
    }
}
