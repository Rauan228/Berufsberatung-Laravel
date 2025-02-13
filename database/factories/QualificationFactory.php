<?php

namespace Database\Factories;

use App\Models\GlobalSpecialty;
use App\Models\Qualification;
use Illuminate\Database\Eloquent\Factories\Factory;

class QualificationFactory extends Factory
{
    protected $model = Qualification::class;

    public function definition()
    {
        return [
            'qualification_name'   => $this->faker->jobTitle,
            'global_specialty_id'  => GlobalSpecialty::factory(),
        ];
    }
}
