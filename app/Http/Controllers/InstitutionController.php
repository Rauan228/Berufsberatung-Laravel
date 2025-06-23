<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\InstitutionApplication; // Добавляем импорт модели InstitutionApplication
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // ✅ Добавляем импорт DB
use Illuminate\Support\Facades\Hash; // ✅ Добавляем импорт Hash
use Illuminate\Support\Facades\Storage; // ✅ Добавляем импорт Storage

class InstitutionController extends Controller
{
    /**
     * Отображает список всех институтов.
     */
    public function index(Request $request)
    {
        $query = Institution::query();

        // Only filter out pending and rejected if we're not an admin
        if (!Auth::guard('admin')->check()) {
            $query->whereNotIn('verified', ['pending', 'rejected']);
        }

        // Filter by type if specified
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Search by name if search term is provided
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $institutions = $query->paginate(12);
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
            'password' => 'required|string|min:6|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::transaction(function () use ($request) {
            // Handle photo upload
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('institutions/photos', 'public');
            }

            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('institutions/logos', 'public');
            }

            // Создаем университет
            $institution = Institution::create([
                'name' => $request->name,
                'email' => $request->email,
                'verified' => 'pending',
                'photo_url' => $photoPath,
                'logo_url' => $logoPath
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'website' => 'nullable|string'
        ]);

        $institution = Institution::findOrFail($id);
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($institution->photo_url) {
                Storage::disk('public')->delete($institution->photo_url);
            }
            $photoPath = $request->file('photo')->store('institutions/photos', 'public');
            $institution->photo_url = $photoPath;
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($institution->logo_url) {
                Storage::disk('public')->delete($institution->logo_url);
            }
            $logoPath = $request->file('logo')->store('institutions/logos', 'public');
            $institution->logo_url = $logoPath;
        }

        // Update description fields
        if ($request->has('description')) {
            $institution->description1 = $request->description;
        }

        // Update other fields
        $institution->name = $request->name;
        if ($request->has('location')) {
            $institution->location = $request->location;
        }
        if ($request->has('website')) {
            $institution->website = $request->website;
        }

        $institution->save();

        return redirect()->route('institutions.index')->with('success', 'Институт успешно обновлен.');
    }

    /**
     * Удаляет институт из базы данных.
     */
    public function destroy($id)
    {
        $institution = Institution::findOrFail($id);
        
        // Delete associated files
        if ($institution->photo_url) {
            Storage::disk('public')->delete($institution->photo_url);
        }
        if ($institution->logo_url) {
            Storage::disk('public')->delete($institution->logo_url);
        }
        
        $institution->delete();

        return redirect()->route('institutions.index')->with('success', 'Институт успешно удален.');
    }
}
