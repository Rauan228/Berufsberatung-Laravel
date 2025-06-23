<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GlobalSpecialty;
use App\Models\CollegeGlobalSpecialty;
use Illuminate\Http\Request;

class GlobalSpecialtyController extends Controller
{
    // Получить список специальностей
    public function index(Request $request)
    {
        $type = $request->query('type', 'all');
        
        if ($type === 'university') {
            $specialties = GlobalSpecialty::with('qualifications.specializations')->get();
            return response()->json([
                'success' => true,
                'data' => $specialties
            ]);
        } elseif ($type === 'college') {
            $specialties = CollegeGlobalSpecialty::with('collegeQualifications.specializations')->get();
            return response()->json([
                'success' => true,
                'data' => $specialties
            ]);
        } else {
            $universitySpecialties = GlobalSpecialty::with('qualifications.specializations')->get();
            $collegeSpecialties = CollegeGlobalSpecialty::with('collegeQualifications.specializations')->get();
            return response()->json([
                'success' => true,
                'data' => [
                    'university' => $universitySpecialties,
                    'college' => $collegeSpecialties
                ]
            ]);
        }
    }

    // Получить детали специальности
    public function show($id, Request $request)
    {
        $type = $request->query('type', 'university');
        
        try {
            if ($type === 'university') {
                $specialty = GlobalSpecialty::with('qualifications.specializations')->findOrFail($id);
            } else {
                $specialty = CollegeGlobalSpecialty::with('collegeQualifications.specializations')->findOrFail($id);
            }
            
            return response()->json([
                'success' => true,
                'data' => $specialty
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Specialty not found'
            ], 404);
        }
    }

    // Создать новую специальность
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:university,college'
        ]);

        try {
            if ($validated['type'] === 'university') {
                $specialty = GlobalSpecialty::create([
                    'name' => $validated['name'],
                    'description' => $validated['description']
                ]);
            } else {
                $specialty = CollegeGlobalSpecialty::create([
                    'name' => $validated['name'],
                    'description' => $validated['description']
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $specialty,
                'message' => 'Specialty created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create specialty'
            ], 500);
        }
    }

    // Обновить специальность
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:university,college'
        ]);

        try {
            if ($validated['type'] === 'university') {
                $specialty = GlobalSpecialty::findOrFail($id);
            } else {
                $specialty = CollegeGlobalSpecialty::findOrFail($id);
            }

            $specialty->update([
                'name' => $validated['name'],
                'description' => $validated['description']
            ]);

            return response()->json([
                'success' => true,
                'data' => $specialty,
                'message' => 'Specialty updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update specialty'
            ], 404);
        }
    }

    // Удалить специальность
    public function destroy($id, Request $request)
    {
        $type = $request->query('type', 'university');
        
        try {
            if ($type === 'university') {
                $specialty = GlobalSpecialty::findOrFail($id);
            } else {
                $specialty = CollegeGlobalSpecialty::findOrFail($id);
            }

            $specialty->delete();

            return response()->json([
                'success' => true,
                'message' => 'Specialty deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete specialty'
            ], 404);
        }
    }

    public function getQualificationsWithSpecializations($id, Request $request)
    {
        $type = $request->query('type', 'university');
        
        try {
            if ($type === 'university') {
                $specialty = GlobalSpecialty::with(['qualifications.specializations'])->findOrFail($id);
            } else {
                $specialty = CollegeGlobalSpecialty::with(['collegeQualifications.specializations'])->findOrFail($id);
            }

            return response()->json([
                'success' => true,
                'data' => $specialty->qualifications ?? $specialty->collegeQualifications
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch qualifications: ' . $e->getMessage()
            ], 404);
        }
    }
}