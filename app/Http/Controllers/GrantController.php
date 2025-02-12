<?php

namespace App\Http\Controllers;

use App\Models\Grant;
use App\Models\Institution;
use App\Models\InstitutionSpecialty;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
use Illuminate\Http\Request;

class GrantController extends Controller
{
    /**
     * Отображает список грантов.
     */
    public function index()
    {
        $grants = Grant::with(['institution', 'specialty'])->get();
        $admin = Auth::guard('admin')->user();
        return view('grants.index', compact('admin','grants'));
    }

    /**
     * Отображает форму создания нового гранта.
     */
    public function create()
    {
        $institutions = Institution::all();
        $specialties = InstitutionSpecialty::all();
        return view('grants.create', compact('institutions', 'specialties'));
    }

    /**
     * Сохраняет новый грант в БД.
     */
    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'specialty_id' => 'required|exists:institution_specialties,id',
            'grant_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'application_deadline' => 'required|date',
        ]);

        Grant::create($request->all());

        return redirect()->route('grants.index')->with('success', 'Грант успешно добавлен.');
    }

    /**
     * Отображает конкретный грант.
     */
    public function show(Grant $grant)
    {
        return view('grants.show', compact('grant'));
    }

    /**
     * Отображает форму редактирования гранта.
     */
    public function edit(Grant $grant)
    {
        $institutions = Institution::all();
        $specialties = InstitutionSpecialty::all();
        return view('grants.edit', compact('grant', 'institutions', 'specialties'));
    }

    /**
     * Обновляет данные гранта.
     */
    public function update(Request $request, Grant $grant)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'specialty_id' => 'required|exists:institution_specialties,id',
            'grant_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'application_deadline' => 'required|date',
        ]);

        $grant->update($request->all());

        return redirect()->route('grants.index')->with('success', 'Грант успешно обновлён.');
    }

    /**
     * Удаляет грант.
     */
    public function destroy(Grant $grant)
    {
        $grant->delete();
        return redirect()->route('grants.index')->with('success', 'Грант удалён.');
    }
}
