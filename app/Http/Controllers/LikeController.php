<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
use App\Models\Like;

class LikeController extends Controller
{
    public function index()
    {
        $likes = Like::with(['user', 'institution'])->latest()->get();
        $admin = Auth::guard('admin')->user();
        return view('likes.index', compact('admin','likes'));
    }

    public function destroy($id)
    {
        $like = Like::findOrFail($id);
        $like->delete();
        return redirect()->route('likes.index')->with('success', 'Лайк удален.');
    }
}
