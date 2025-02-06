<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
use App\Models\Institution;
use App\Models\User;
use App\Models\Review;
use App\Models\InstitutionSpecialty;

class HomeController extends Controller
{
    public function index()
{
    // Подсчитываем количество университетов (институтов)
    $institutesCount = Institution::count();

    // Подсчитываем количество пользователей
    $usersCount = User::count();

    // Подсчитываем количество специальностей
    $specialtiesCount = InstitutionSpecialty::count();

    // Получаем последний отзыв с подгрузкой пользователя
    $latestReview = Review::latest()->with('user')->first();

    // Получаем текущего вошедшего админа
    $admin = Auth::guard('admin')->user();

    // Передаем данные в представление
    return view('home', compact('admin', 'institutesCount', 'usersCount', 'specialtiesCount', 'latestReview'));
}

    

}
