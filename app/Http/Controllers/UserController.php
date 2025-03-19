<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $activePage = $request->input('active_page', 1);
        $bannedPage = $request->input('banned_page', 1);
        $tab = $request->input('tab', 'active-users');

        $activeUsers = User::where('is_banned', false)
            ->paginate(24, ['*'], 'active_page', $activePage);
        $bannedUsers = User::where('is_banned', true)
            ->paginate(24, ['*'], 'banned_page', $bannedPage);
        
        $admin = Auth::guard('admin')->user();
        
        return view('users.index', compact('admin', 'activeUsers', 'bannedUsers', 'tab'));
    }

    public function toggleBan($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = !$user->is_banned;
        $user->save();
    
        return redirect()->back()->with('success', "Пользователь {$user->username} " . 
            ($user->is_banned ? 'заблокирован' : 'разблокирован') . ".");
    }
}
