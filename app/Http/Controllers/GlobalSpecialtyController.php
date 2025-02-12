<?php

namespace App\Http\Controllers;

use App\Models\GlobalSpecialty;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
use Illuminate\Http\Request;

class GlobalSpecialtyController extends Controller
{
    /**
     * Отобразить список всех глобальных специальностей.
     */
    public function index()
    {
        $globalSpecialties = GlobalSpecialty::all();
        $admin = Auth::guard('admin')->user();
        return view('global_specialties.index', compact('admin','globalSpecialties'));
    }

    /**
     * Показать форму для создания новой специальности.
     */
    public function create()
    {
        return view('global_specialties.create');
    }

    /**
     * Сохранить новую специальность в базе данных.
     */
    public function store(Request $request)
    {
        $request->validate([
            'specialty_name' => 'required|unique:global_specialties|max:255',
        ]);

        GlobalSpecialty::create($request->all());

        return redirect()->route('global_specialties.index')->with('success', 'Specialty added successfully.');
    }

    /**
     * Показать форму редактирования существующей специальности.
     */
    public function edit(GlobalSpecialty $globalSpecialty)
    {
        return view('global_specialties.edit', compact('globalSpecialty'));
    }

    /**
     * Обновить данные существующей специальности.
     */
    public function update(Request $request, GlobalSpecialty $globalSpecialty)
    {
        $request->validate([
            'specialty_name' => 'required|unique:global_specialties,specialty_name,' . $globalSpecialty->id . '|max:255',
        ]);

        $globalSpecialty->update($request->all());

        return redirect()->route('global_specialties.index')->with('success', 'Specialty updated successfully.');
    }

    /**
     * Удалить специальность.
     */
    public function destroy(GlobalSpecialty $globalSpecialty)
    {
        $globalSpecialty->delete();
        return redirect()->route('global_specialties.index')->with('success', 'Specialty deleted successfully.');
    }
}
