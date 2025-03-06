<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Получить список пользователей
    public function index(Request $request)
    {
        $activePage = $request->input('active_page', 1);
        $bannedPage = $request->input('banned_page', 1);

        $activeUsers = User::where('is_banned', false)->paginate(24, ['*'], 'active_page', $activePage);
        $bannedUsers = User::where('is_banned', true)->paginate(24, ['*'], 'banned_page', $bannedPage);

        return response()->json([
            'active_users' => $activeUsers,
            'banned_users' => $bannedUsers,
        ]);
    }

    public function getCurrentUser()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Пользователь не авторизован'], 401);
        }
    
        $user = Auth::user();
        return response()->json([
            'username' => $user->username,
            'email' => $user->email,
        ]);
    }

    // Получить отзывы текущего пользователя
    public function getUserReviews()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Пользователь не авторизован'], 401);
        }

        $user = Auth::user();
        $reviews = $user->reviews()->with('institution')->get();

        return response()->json($reviews);
    }

    // Заблокировать/разблокировать пользователя
    public function toggleBan($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = !$user->is_banned;
        $user->save();

        return response()->json([
            'message' => "Пользователь {$user->username} " . ($user->is_banned ? 'заблокирован' : 'разблокирован') . ".",
        ]);
    }
}