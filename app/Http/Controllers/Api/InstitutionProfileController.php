<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InstitutionProfileController extends Controller
{
    // GET /api/institution/profile
    public function show()
    {
        $institution = Auth::user();
        if (!$institution) {
            return response()->json(['error' => 'Не авторизован'], 401);
        }

        // Подгружаем только нужные связанные данные, исключая специализации, заявки и отзывы
        $institution->load([
            // no additional relations to avoid name conflict with boolean column 'grants'
        ]);

        return response()->json($institution);
    }

    // PUT /api/institution/profile
    public function update(Request $request)
    {
        $institution = Auth::user();
        if (!$institution) {
            return response()->json(['error' => 'Не авторизован'], 401);
        }

        $validated = $request->validate([
            'name'          => 'sometimes|string|max:255',
            'location'      => 'sometimes|string|max:255',
            'address'       => 'sometimes|string|max:255',
            'latitude'      => 'nullable|numeric',
            'longitude'     => 'nullable|numeric',
            'email'         => 'sometimes|email|max:255',
            'phone'         => 'sometimes|string|max:50',
            'website'       => 'sometimes|string|max:255',
            'directions'    => 'nullable|string',
            'description1'  => 'nullable|string',
            'description2'  => 'nullable|string',
            'description3'  => 'nullable|string',
            'dormitory'     => 'sometimes|boolean',
            'grants'        => 'sometimes|boolean',
            'password'      => 'sometimes|string|min:6|confirmed',

            // Файлы
            'logo'          => 'sometimes|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo'         => 'sometimes|file|image|mimes:jpeg,png,jpg,gif|max:4096',

            // Флаги удаления файлов
            'remove_logo'   => 'sometimes|boolean',
            'remove_photo'  => 'sometimes|boolean',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Обработка логотипа
        if ($request->boolean('remove_logo')) {
            if ($institution->logo_url) {
                Storage::delete(str_replace('/storage/', '', $institution->logo_url));
            }
            $institution->logo_url = null;
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('institutions/logos', 'public');
            $institution->logo_url = $path;
        }

        // Обработка фото
        if ($request->boolean('remove_photo')) {
            if ($institution->photo_url) {
                Storage::delete(str_replace('/storage/', '', $institution->photo_url));
            }
            $institution->photo_url = null;
        }

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('institutions/photos', 'public');
            $institution->photo_url = $path;
        }

        // directions может прийти как строка (comma separated) или массив
        if ($request->has('directions')) {
            $directionsInput = $request->input('directions');
            if (is_array($directionsInput)) {
                $validated['directions'] = implode(',', $directionsInput);
            }
        }

        $institution->fill($validated);

        // Хешируем пароль если был передан выше
        // fill позовет сеттер password

        $institution->save();

        return response()->json(['message' => 'Профиль обновлен', 'institution' => $institution]);
    }
} 