<?php

namespace App\Http\Controllers;

use App\Models\CareerTestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CareerOrientationService;


class CareerTestController extends Controller
{
    public function store(Request $request)
{
    $data = $request->validate([
        'institution_type' => 'required|in:college,university',
        'answers'          => 'required|array|min:1',
    ]);

    $result = CareerTestResult::create([
        'user_id'          => Auth::id(),
        'institution_type' => $data['institution_type'],
        'answers'          => $data['answers'],
    ]);

    // Генерация summary + рекомендаций
    app(CareerOrientationService::class)->process($result);

    return response()->json($result->fresh(), 201);
}
    public function index(Request $request)
    {
        $results = CareerTestResult::where('user_id', Auth::id())
            ->latest()
            ->get();
        return response()->json($results);
    }

    public function show(CareerTestResult $careerTestResult)
    {
        // Возвращаем только свои результаты
        if ($careerTestResult->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return response()->json($careerTestResult);
    }
} 