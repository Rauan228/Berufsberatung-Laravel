<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Institution;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class InstitutionController extends Controller
{
    // Получить список институтов
    // Получить список институтов
    public function index()
    {
        $institutions = Institution::whereNotIn('verified', ['pending', 'rejected'])
            ->withCount('reviews') // Добавляем количество отзывов
            ->withAvg('reviews', 'rating') // Добавляем средний рейтинг
            ->paginate(100);

        return response()->json($institutions);
    }
    public function getLikedInstitutions()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Пользователь не авторизован'], 401);
        }

        $likedInstitutions = Like::where('user_id', $user->id)
            ->with([
                'institution' => function ($query) {
                    $query->withAvg('reviews', 'rating'); // Добавляем средний рейтинг
                }
            ])
            ->get()
            ->pluck('institution');

        return response()->json($likedInstitutions);
    }
    // Создать новый институт
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:institutions,name',
            'email' => 'required|email|max:255|unique:institutions,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $institution = Institution::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'verified' => 'pending',
        ]);

        return response()->json($institution, 201);
    }

    // Получить детали института
    public function show($id)
    {
        try {
            $institution = Institution::with([
                'specializations.qualification' => function ($query) {
                    $query->select('id', 'qualification_name'); // Выбираем только нужные поля
                },
                'specializations' => function ($query) {
                    $query->select('specializations.id', 'specializations.name', 'qualification_id')
                        ->withPivot('cost', 'duration');
                }
            ])->findOrFail($id);

            return response()->json($institution);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Institution not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    public function getReviews($institutionId)
    {
        $reviews = Review::where('institution_id', $institutionId)
            ->with('user') // Загружаем данные пользователя
            ->latest()
            ->get();

        return response()->json($reviews);
    }

    // Обновить институт
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $institution = Institution::findOrFail($id);
        $institution->update($request->all());
        return response()->json($institution);
    }

    public function storeReview(Request $request, $id)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Пользователь не авторизован'], 401);
        }

        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000'
        ]);

        $institution = Institution::findOrFail($id);

        $review = Review::create([
            'user_id' => $user->id,
            'institution_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        // Загружаем данные пользователя для ответа
        $review->load('user');

        return response()->json($review, 201);
    }
    // Удалить институт
    public function destroy($id)
    {
        Institution::destroy($id);
        return response()->json(null, 204);
    }
    public function like($id, Request $request)
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $institution = Institution::findOrFail($id);
            $institution->likes()->attach($user->id);

            return response()->json(['message' => 'Liked successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function unlike($institutionId)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Пользователь не авторизован'], 401);
        }

        $like = Like::where('user_id', $user->id)
            ->where('institution_id', $institutionId)
            ->first();

        if (!$like) {
            return response()->json(['message' => 'Лайк не найден'], 404);
        }

        $like->delete();

        return response()->json(['message' => 'Лайк удалён'], 200);
    }


}