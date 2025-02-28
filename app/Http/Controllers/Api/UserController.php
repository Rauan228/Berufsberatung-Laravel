<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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