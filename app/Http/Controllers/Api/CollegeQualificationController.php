<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CollegeQualification;
use Illuminate\Http\Request;

class CollegeQualificationController extends Controller
{
    /**
     * Display a listing of the qualifications.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $qualifications = CollegeQualification::with(['collegeGlobalSpecialty', 'collegeSpecializations'])->get();

        return response()->json([
            'success' => true,
            'data' => $qualifications
        ]);
    }

    /**
     * Display the specified qualification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $qualification = CollegeQualification::with(['collegeGlobalSpecialty', 'collegeSpecializations'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $qualification
        ]);
    }
} 