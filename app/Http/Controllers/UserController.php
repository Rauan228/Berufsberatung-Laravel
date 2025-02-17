<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth

class UserController extends Controller
{
    public function index(Request $request)
    {
       // Получаем текущую страницу для активных и забаненных пользователей
    $activePage = $request->input('active_page', 1);
    $bannedPage = $request->input('banned_page', 1);

    // Получаем активных и забаненных пользователей с пагинацией
    $activeUsers = User::where('is_banned', false)->paginate(24, ['*'], 'active_page', $activePage);
    $bannedUsers = User::where('is_banned', true)->paginate(24, ['*'], 'banned_page', $bannedPage);
        
        // Получаем текущего вошедшего админа
        $admin = Auth::guard('admin')->user();
        
        // Передаем данные в представление
        return view('users.index', compact('admin', 'activeUsers', 'bannedUsers'));
    }
    

    

    public function toggleBan($id)
    {
        $user = User::findOrFail($id);
        
        // Меняем значение is_banned и сохраняем в БД
        $user->is_banned = !$user->is_banned;
        $user->save();
    
        return redirect()->back()->with('success', "Пользователь {$user->username} " . ($user->is_banned ? 'заблокирован' : 'разблокирован') . ".");
    }
    
    

}
