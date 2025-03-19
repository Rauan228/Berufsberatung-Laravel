<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use App\Models\GlobalSpecialty;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    public function index()
    {
        $qualifications = Qualification::with('globalSpecialty')->paginate(12); // Укажите нужное количество элементов на страницу

        $admin = Auth::guard('admin')->user();
        return view('qualifications.index', compact('admin','qualifications'));
    }

    public function create()
    {
        $specialties = GlobalSpecialty::all();
        return view('qualifications.create', compact('specialties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'qualification_name' => 'required|string|max:255',
            'global_specialty_id' => 'required|exists:global_specialties,id',
        ]);

        Qualification::create($request->all());

        return redirect()->route('qualifications.index')->with('success', 'Квалификация добавлена');
    }

    public function edit(Qualification $qualification)
    {
        $specialties = GlobalSpecialty::all();
        return view('qualifications.edit', compact('qualification', 'specialties'));
    }

    public function update(Request $request, Qualification $qualification)
    {
        $request->validate([
            'qualification_name' => 'required|string|max:255',
            'global_specialty_id' => 'required|exists:global_specialties,id',
        ]);

        $qualification->update($request->all());

        return redirect()->route('qualifications.index')->with('success', 'Квалификация обновлена');
    }

    public function destroy(Qualification $qualification)
    {
        $qualification->delete();
        return redirect()->route('qualifications.index')->with('success', 'Квалификация удалена');
    }
}
