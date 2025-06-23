<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewInstitutionController extends Controller
{
    public function index()
    {
        try {
            $institutions = Institution::withCount(['reviews', 'likes'])
                ->withAvg('reviews', 'rating')
                ->with(['specializations' => function($query) {
                    $query->with('qualification');
                }])
                ->get();

            return response()->json($institutions);
        } catch (\Exception $e) {
            Log::error('Error in index: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    public function show($id)
    {
        try {
            $institution = Institution::with([
                'specializations' => function($query) {
                    $query->with('qualification');
                },
                'reviews' => function($query) {
                    $query->latest();
                }
            ])
            ->withCount('likes')
            ->findOrFail($id);

            // Добавляем среднюю оценку
            $institution->average_rating = $institution->reviews()->avg('rating') ?? 0;

            return response()->json($institution);
        } catch (\Exception $e) {
            Log::error('Error in show: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
} 