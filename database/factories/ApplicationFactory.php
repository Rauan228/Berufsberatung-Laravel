<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'event_id' => \App\Models\EventsCalendar::factory(),
            'status' => $this->faker->randomElement(['Pending', 'Accepted', 'Rejected']),
            'applied_at' => now(),
        ];
    }
}

