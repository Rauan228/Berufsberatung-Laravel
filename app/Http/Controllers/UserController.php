<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth

class UserController extends Controller
{
    public function index()
    {
        // Получаем всех пользователей с необходимыми полями
        $users = User::select('id', 'username', 'created_at', 'is_banned')->get();
         // Получаем текущего вошедшего админа
        $admin = Auth::guard('admin')->user();
    
        // Передаем данные в представление
        return view('users.index', compact('admin','users'));
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
