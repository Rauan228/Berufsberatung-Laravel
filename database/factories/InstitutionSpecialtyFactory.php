<?php

namespace Database\Factories;

use App\Models\InstitutionSpecialty;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstitutionSpecialtyFactory extends Factory
{
    protected $model = InstitutionSpecialty::class;

    public function definition()
    {
        return [
            'institution_id' => \App\Models\Institution::factory(),
            'specialty_id' => \App\Models\GlobalSpecialty::factory(),
            'specialty_name' => $this->faker->word,
        ];
    }
}

