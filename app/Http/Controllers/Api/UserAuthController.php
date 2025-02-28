<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    /**
     * Регистрация пользователя
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Создаем токен после успешной регистрации
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'message' => 'Регистрация успешна',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201);
    }
    

    /**
     * Вход пользователя
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json(['error' => 'Неверные учетные данные'], 401);
    }

    /**
     * Выход пользователя
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Выход выполнен успешно']);
    }
}
