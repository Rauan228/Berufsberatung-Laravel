<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\Qualification;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
class SpecializationController extends Controller
{
    public function index(Request $request)
{
        $query = Specialization::with(['qualification.globalSpecialty']);

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->has('qualification_id') && $request->qualification_id != '') {
        $query->where('qualification_id', $request->qualification_id);
    }

    $specializations = $query->paginate(48);

        $qualifications = Qualification::with('globalSpecialty')->get(); // Получаем список всех квалификаций с их специальностями
    $admin = Auth::guard('admin')->user();

    return view('specializations.index', compact('admin', 'specializations', 'qualifications'));
}


    public function create()
    {
        $qualifications = Qualification::all();
        return view('specializations.create', compact('qualifications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'qualification_id' => 'required|exists:qualifications,id',
        ]);

        Specialization::create($request->only('name', 'qualification_id'));

        return redirect()->route('specializations.index')->with('success', 'Специализация добавлена');
    }

    public function edit(Specialization $specialization)
    {
        $qualifications = Qualification::all();
        return view('specializations.edit', compact('specialization', 'qualifications'));
    }

    public function update(Request $request, Specialization $specialization)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'qualification_id' => 'required|exists:qualifications,id',
        ]);

        $specialization->update($request->only('name', 'qualification_id'));

        return redirect()->route('specializations.index')->with('success', 'Специализация обновлена');
    }

    public function destroy(Specialization $specialization)
    {
        $specialization->delete();
        return redirect()->route('specializations.index')->with('success', 'Специализация удалена');
    }
}
