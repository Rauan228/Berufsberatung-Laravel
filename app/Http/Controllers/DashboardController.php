<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\User;
use App\Models\InstitutionSpecialty;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        // Подсчитываем количество университетов (институтов)
        $institutesCount = Institution::count();

        // Подсчитываем количество пользователей
        $usersCount = User::count();

        // Подсчитываем количество специальностей
        $specialtiesCount = InstitutionSpecialty::count();

        // Получаем последний отзыв
        $latestReview = Review::latest()->first();

        // Передаем данные в представление
        return view('home', compact('institutesCount', 'usersCount', 'specialtiesCount', 'latestReview'));
    }
}