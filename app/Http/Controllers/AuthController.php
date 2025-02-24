<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AuthController extends Controller
{
    // Метод для отображения формы входа
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Метод для обработки входа
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('name', $request->name)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('home');
        }

        return back()->withErrors(['name' => 'Неверные учетные данные']);
    }

    // Метод для выхода
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }

 
}