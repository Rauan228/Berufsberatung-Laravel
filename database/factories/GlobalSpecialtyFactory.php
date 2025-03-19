<?php

namespace Database\Factories;

use App\Models\GlobalSpecialty;
use Illuminate\Database\Eloquent\Factories\Factory;

class GlobalSpecialtyFactory extends Factory
{
    protected $model = GlobalSpecialty::class;

    public function definition()
    {
        return [
            'specialty_name' => $this->faker->word,
        ];
    }
}

