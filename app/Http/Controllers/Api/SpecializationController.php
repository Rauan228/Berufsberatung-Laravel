<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Models\CollegeSpecialization;
use App\Models\Qualification;
use App\Models\GlobalSpecialty;
use App\Models\CollegeGlobalSpecialty;
use App\Models\UniversityGlobalSpecialty;

class SpecializationController extends Controller
{
    // Получить список специализаций
    public function index(Request $request)
    {
        try {
            $type = $request->query('type', 'university');
            $search = $request->query('search');
            $qualificationId = $request->query('qualification_id');

            if ($type === 'college') {
                $query = CollegeGlobalSpecialty::with(['collegeQualifications.specializations']);
            } else {
                $query = GlobalSpecialty::with(['qualifications.specializations']);
            }

            if ($search) {
                $query->where('name', 'like', "%{$search}%");
        }

            if ($qualificationId) {
                if ($type === 'college') {
                    $query->whereHas('collegeQualifications', function ($q) use ($qualificationId) {
                        $q->where('id', $qualificationId);
                    });
                } else {
                    $query->whereHas('qualifications', function ($q) use ($qualificationId) {
                        $q->where('id', $qualificationId);
                    });
                }
        }

            $specialties = $query->paginate(48);

            return response()->json([
                'success' => true,
                'data' => $specialties->items(),
                'meta' => [
                    'current_page' => $specialties->currentPage(),
                    'last_page' => $specialties->lastPage(),
                    'per_page' => $specialties->perPage(),
                    'total' => $specialties->total()
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in SpecializationController@index: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при получении списка специальностей'
            ], 500);
        }
    }

    // Создать новую специализацию
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'qualification_id' => 'required|exists:qualifications,id',
        ]);

        $specialization = Specialization::create($request->only('name', 'qualification_id'));
        return response()->json($specialization, 201);
    }

    // Получить детали специализации
    public function show($id)
    {
        try {
            $type = request('type', 'university');
            
            if ($type === 'college') {
                $specialization = CollegeSpecialization::with([
                    'qualification.collegeGlobalSpecialty',
                    'institutions' => function($query) {
                        $query->select('institutions.*', 'college_institution_specs.cost', 'college_institution_specs.duration');
                    }
                ])->findOrFail($id);
            } else {
                $specialization = Specialization::with([
                    'qualification.globalSpecialty',
                    'institutions' => function($query) {
                        $query->select('institutions.*', 'institution_specialties.cost', 'institution_specialties.duration');
                    }
                ])->findOrFail($id);
            }
            
            return response()->json([
                'success' => true,
                'data' => $specialization
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching specialization: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Специальность не найдена'
            ], 404);
        }
    }

    public function institutions($id)
    {
        try {
            $type = request('type', 'university');
            
            if ($type === 'college') {
                $specialization = CollegeSpecialization::with(['institutions' => function($query) {
                    $query->select('institutions.*', 'college_institution_specs.cost', 'college_institution_specs.duration');
                }])->findOrFail($id);
                
                $institutions = $specialization->institutions()
                    ->with(['reviews' => function($query) {
                        $query->select('institution_id', 'rating');
                    }])
                    ->withCount('reviews')
                    ->withAvg('reviews', 'rating')
                    ->get();
            } else {
                $specialization = Specialization::with(['institutions' => function($query) {
                    $query->select('institutions.*', 'institution_specialties.cost', 'institution_specialties.duration');
                }])->findOrFail($id);
                
                $institutions = $specialization->institutions()
                    ->with(['reviews' => function($query) {
                        $query->select('institution_id', 'rating');
                    }])
                    ->withCount('reviews')
                    ->withAvg('reviews', 'rating')
                    ->get();
            }
            
            return response()->json([
                'success' => true,
                'data' => $institutions
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching institutions: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Не удалось загрузить список учебных заведений'
            ], 500);
        }
    }

    // Обновить специализацию
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'qualification_id' => 'required|exists:qualifications,id',
        ]);

        $specialization = Specialization::findOrFail($id);
        $specialization->update($request->only('name', 'qualification_id'));
        return response()->json($specialization);
    }

    // Удалить специализацию
    public function destroy($id)
    {
        Specialization::destroy($id);
        return response()->json(null, 204);
    }
}