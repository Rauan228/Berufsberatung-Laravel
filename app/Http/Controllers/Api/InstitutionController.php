<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Institution;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use App\Models\InstitutionApplication;


class InstitutionController extends Controller
{
    public function getCurrentInstitution(Request $request)
{
    try {
        $institution = Auth::guard('institution')->user();
        
        if (!$institution) {
            return response()->json(['error' => 'Не авторизован'], 401);
        }

        return response()->json([
            'institution' => $institution,
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function login(Request $request)
{
    try {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('institution')->attempt($credentials)) {
            $institution = Auth::guard('institution')->user();

            if ($institution->verified !== 'accepted') {
                Auth::guard('institution')->logout();
                return response()->json([
                    'error' => 'Ваш аккаунт еще не подтвержден'
                ], 403);
            }

            // Создаем токен с указанием guard
            $token = $institution->createToken('institution-token', ['institution'])->plainTextToken;

            return response()->json([
                'message' => 'Успешный вход',
                'institution' => $institution,
                'token' => $token
            ], 200);
        }

        return response()->json([
            'error' => 'Неверные учетные данные'
        ], 401);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['errors' => $e->errors()], 422);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:institutions,name',
                'email' => 'required|email|max:255|unique:institutions,email',
                'password' => 'required|string|min:6|confirmed',
                'location' => 'required|string|max:255',
                'phone' => 'required|string|max:50',
                'website' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'dormitory' => 'required|boolean',
                'grants' => 'required|boolean',
                'specializations' => 'required|array',
                'specializations.*' => 'exists:specializations,id',
            ]);
    
            DB::beginTransaction();
    
            // Создаем запись в institutions
            $institution = Institution::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password, // Мутатор хеширует пароль
                'location' => $request->location,
                'phone' => $request->phone,
                'website' => $request->website,
                'address' => $request->address,
                'dormitory' => $request->dormitory,
                'grants' => $request->grants,
                'verified' => 'pending',
            ]);
    
            // Создаем запись в institution_applications
            $application = InstitutionApplication::create([
                'institution_id' => $institution->id,
                'institution_name' => $institution->name,
                'email' => $institution->email,
                'password' => $request->password, // Мутатор хеширует пароль
                'verified' => 'pending',
            ]);
    
            // Привязываем специальности
            if (!empty($request->specializations)) {
                $institution->specializations()->attach($request->specializations);
            }
    
            DB::commit();
    
            return response()->json([
                'message' => 'Университет успешно зарегистрирован и заявка отправлена на рассмотрение.',
                'institution' => $institution,
                'application' => $application,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // Остальные методы остаются без изменений
    public function index()
{
    $institutions = Institution::withCount('reviews')
        ->withAvg('reviews', 'rating')
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
                    $query->withAvg('reviews', 'rating');
                }
            ])
            ->get()
            ->pluck('institution');

        return response()->json($likedInstitutions);
    }

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

    public function show($id)
    {
        try {
            $institution = Institution::with([
                'specializations.qualification' => function ($query) {
                    $query->select('id', 'qualification_name');
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
            ->with('user')
            ->latest()
            ->get();

        return response()->json($reviews);
    }

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

        $review->load('user');

        return response()->json($review, 201);
    }

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