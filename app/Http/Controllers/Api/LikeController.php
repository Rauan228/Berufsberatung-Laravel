<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Institution;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Получить список лайков
    public function index()
    {
        $likes = Like::with(['user', 'institution'])->latest()->get();
        return response()->json($likes);
    }

    // Добавить лайк
    public function store(Request $request, $institutionId)
    {
        try {
            $institution = Institution::findOrFail($institutionId);
            $user = Auth::user();

            // Проверяем, не лайкнул ли уже пользователь это учреждение
            $existingLike = Like::where('user_id', $user->id)
                ->where('institution_id', $institutionId)
                ->first();

            if ($existingLike) {
                return response()->json(['message' => 'Already liked'], 400);
            }

            $like = new Like();
            $like->user_id = $user->id;
            $like->institution_id = $institutionId;
            $like->save();

            return response()->json($like, 201);
        } catch (\Exception $e) {
            \Log::error('Error adding like: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add like'], 500);
        }
    }

    // Удалить лайк
    public function destroy($institutionId)
    {
        try {
            $user = Auth::user();
            $like = Like::where('user_id', $user->id)
                ->where('institution_id', $institutionId)
                ->first();

            if (!$like) {
                return response()->json(['message' => 'Like not found'], 404);
            }

            $like->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            \Log::error('Error removing like: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to remove like'], 500);
        }
    }

    // Получить список лайкнутых учреждений пользователя
    public function likedInstitutions()
    {
        try {
            $user = Auth::user();
            $likedInstitutions = Institution::whereHas('likes', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();

            return response()->json($likedInstitutions);
        } catch (\Exception $e) {
            \Log::error('Error fetching liked institutions: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch liked institutions'], 500);
        }
    }
}