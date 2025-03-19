<?php

namespace Database\Factories;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'institution_id' => \App\Models\Institution::factory(),
            'created_at' => now(),
        ];
    }
}
