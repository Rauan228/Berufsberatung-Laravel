<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    // Получить список лайков
    public function index()
    {
        $likes = Like::with(['user', 'institution'])->latest()->get();
        return response()->json($likes);
    }

    // Удалить лайк
    public function destroy($id)
    {
        Like::destroy($id);
        return response()->json(null, 204);
    }
}