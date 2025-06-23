<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GlobalSpecialty;

class UniversityCatalogController extends Controller
{
    public function __invoke()
    {
        $data = GlobalSpecialty::with('qualifications.specializations')->get();
        return response()->json($data);
    }
} 