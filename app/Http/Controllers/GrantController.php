<?php

namespace App\Http\Controllers;

use App\Models\Grant;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrantController extends Controller
{
    // Отображение всех грантов
    public function index()
    {
        $grants = Grant::with('institution')->paginate(12);
        $admin = Auth::guard('admin')->user();
        return view('grants.index', compact('admin', 'grants'));
    }

    // Показать форму для создания нового гранта
    public function create()
    {
        $institutions = Institution::all();
        return view('grants.create', compact('institutions'));
    }

    // Сохранение нового гранта
    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'grant_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'application_deadline' => 'required|date',
        ]);

        Grant::create($request->all());

        return redirect()->route('grants.index')->with('success', 'Grant created successfully.');
    }

    // Показать форму для редактирования гранта
    public function edit(Grant $grant)
    {
        $institutions = Institution::all();
        return view('grants.edit', compact('grant', 'institutions'));
    }

    // Обновление гранта
    public function update(Request $request, Grant $grant)
    {
        $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'grant_name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'application_deadline' => 'required|date',
        ]);

        $grant->update($request->all());

        return redirect()->route('grants.index')->with('success', 'Grant updated successfully.');
    }

    // Удаление гранта
    public function destroy(Grant $grant)
    {
        $grant->delete();

        return redirect()->route('grants.index')->with('success', 'Grant deleted successfully.');
    }
}
