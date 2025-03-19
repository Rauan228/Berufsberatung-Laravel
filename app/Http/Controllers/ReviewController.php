<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;  // Импортируем фасад Auth
class ReviewController extends Controller
{
    public function index(Request $request)
    {
        // Пагинация и сортировка по дате
        $reviews = Review::with(['user', 'institution'])
                        ->latest()
                        ->paginate(20);  // Здесь 10 — количество отзывов на одной странице

        $admin = Auth::guard('admin')->user();

        return view('reviews.index', compact('admin', 'reviews'));
    }


    public function destroy($id)
{
    $review = Review::findOrFail($id);
    $review->delete();

    return redirect()->route('reviews.index')->with('success', 'Отзыв удален.');
}

}