<?php

namespace Database\Factories;

use App\Models\Grant;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrantFactory extends Factory
{
    protected $model = Grant::class;

    public function definition()
    {
        return [
            'institution_id' => \App\Models\Institution::factory(),
            'grant_name' => $this->faker->word,
            'amount' => $this->faker->randomFloat(2, 1000, 100000),
            'application_deadline' => $this->faker->date,
        ];
    }
}
