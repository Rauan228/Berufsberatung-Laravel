<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    // Получить список отзывов
    public function index()
    {
        $reviews = Review::with(['user', 'institution'])->latest()->paginate(20);
        return response()->json($reviews);
    }

    // Удалить отзыв
    public function destroy($id)
    {
        Review::destroy($id);
        return response()->json(null, 204);
    }
}