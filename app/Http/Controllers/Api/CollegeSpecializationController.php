<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CollegeGlobalSpecialty;
use App\Models\CollegeSpecialization;
use App\Models\Institution;
use Illuminate\Http\Request;

class CollegeSpecializationController extends Controller
{
    public function index()
    {
        try {
            $query = CollegeSpecialization::with([
                'qualification.collegeGlobalSpecialty',
                'institutions' => function($query) {
                    $query->select('institutions.*', 'college_institution_specs.cost', 'college_institution_specs.duration');
                }
            ]);

            if (request('search')) {
                $query->where('name', 'like', '%' . request('search') . '%');
            }

            if (request('qualification_id')) {
                $query->where('qualification_id', request('qualification_id'));
            }

            $specializations = $query->paginate(48);
            
            return response()->json([
                'success' => true,
                'data' => $specializations->map(function($specialization) {
                    return [
                        'id' => $specialization->id,
                        'name' => $specialization->name,
                        'description' => $specialization->description,
                        'about1' => $specialization->about1,
                        'about2' => $specialization->about2,
                        'about3' => $specialization->about3,
                        'requirements' => $specialization->requirements,
                        'opportunities' => $specialization->opportunities,
                        'skills' => $specialization->skills,
                        'qualification' => [
                            'id' => $specialization->qualification->id,
                            'name' => $specialization->qualification->qualification_name,
                            'description' => $specialization->qualification->description,
                            'global_specialty' => [
                                'id' => $specialization->qualification->collegeGlobalSpecialty->id,
                                'name' => $specialization->qualification->collegeGlobalSpecialty->name,
                                'description' => $specialization->qualification->collegeGlobalSpecialty->description
                            ]
                        ],
                        'institutions' => $specialization->institutions->map(function($institution) {
                            return [
                                'id' => $institution->id,
                                'name' => $institution->name,
                                'cost' => $institution->pivot->cost,
                                'duration' => $institution->pivot->duration
                            ];
                        })
                    ];
                }),
                'meta' => [
                    'current_page' => $specializations->currentPage(),
                    'last_page' => $specializations->lastPage(),
                    'per_page' => $specializations->perPage(),
                    'total' => $specializations->total()
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching college specializations: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch college specializations: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $specialization = CollegeSpecialization::with([
                'qualification.collegeGlobalSpecialty',
                'institutions' => function($query) {
                    $query->select('institutions.*', 'college_institution_specs.cost', 'college_institution_specs.duration');
                }
            ])->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $specialization->id,
                    'name' => $specialization->name,
                    'description' => $specialization->description,
                    'about1' => $specialization->about1,
                    'about2' => $specialization->about2,
                    'about3' => $specialization->about3,
                    'requirements' => $specialization->requirements,
                    'opportunities' => $specialization->opportunities,
                    'skills' => $specialization->skills,
                    'qualification' => [
                        'id' => $specialization->qualification->id,
                        'name' => $specialization->qualification->qualification_name,
                        'description' => $specialization->qualification->description,
                        'global_specialty' => [
                            'id' => $specialization->qualification->collegeGlobalSpecialty->id,
                            'name' => $specialization->qualification->collegeGlobalSpecialty->name,
                            'description' => $specialization->qualification->collegeGlobalSpecialty->description
                        ]
                    ],
                    'institutions' => $specialization->institutions->map(function($institution) {
                        return [
                            'id' => $institution->id,
                            'name' => $institution->name,
                            'description1' => $institution->description1,
                            'description2' => $institution->description2,
                            'description3' => $institution->description3,
                            'location' => $institution->location,
                            'email' => $institution->email,
                            'phone' => $institution->phone,
                            'website' => $institution->website,
                            'logo_url' => $institution->logo_url,
                            'photo_url' => $institution->photo_url,
                            'cost' => $institution->pivot->cost,
                            'duration' => $institution->pivot->duration
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching college specialization: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'College specialization not found: ' . $e->getMessage()
            ], 404);
        }
    }

    public function institutions($id)
    {
        try {
            $specialization = CollegeSpecialization::with(['institutions' => function($query) {
                $query->select('institutions.*', 'college_institution_specs.cost', 'college_institution_specs.duration');
            }])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $specialization->institutions->map(function($institution) {
                    return [
                        'id' => $institution->id,
                        'name' => $institution->name,
                        'description1' => $institution->description1,
                        'description2' => $institution->description2,
                        'description3' => $institution->description3,
                        'location' => $institution->location,
                        'email' => $institution->email,
                        'phone' => $institution->phone,
                        'website' => $institution->website,
                        'logo_url' => $institution->logo_url,
                        'photo_url' => $institution->photo_url,
                        'cost' => $institution->pivot->cost,
                        'duration' => $institution->pivot->duration
                    ];
                })
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching institutions: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch institutions for this specialization: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
                'description' => 'required|string',
                'college_qualification_id' => 'required|exists:college_qualifications,id',
                'about1' => 'nullable|string',
                'about2' => 'nullable|string',
                'about3' => 'nullable|string'
        ]);

            $specialization = CollegeSpecialization::create($validated);
            
            return response()->json([
                'success' => true,
                'data' => $specialization,
                'message' => 'College specialization created successfully'
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating college specialization: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to create college specialization: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
                'description' => 'required|string',
                'college_qualification_id' => 'required|exists:college_qualifications,id',
                'about1' => 'nullable|string',
                'about2' => 'nullable|string',
                'about3' => 'nullable|string'
        ]);

            $specialization = CollegeSpecialization::findOrFail($id);
            $specialization->update($validated);

            return response()->json([
                'success' => true,
                'data' => $specialization,
                'message' => 'College specialization updated successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating college specialization: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update college specialization: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $specialization = CollegeSpecialization::findOrFail($id);
            $specialization->delete();

            return response()->json([
                'success' => true,
                'message' => 'College specialization deleted successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error deleting college specialization: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete college specialization: ' . $e->getMessage()
            ], 500);
        }
    }
} 