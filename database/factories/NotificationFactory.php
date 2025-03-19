<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'event_id' => \App\Models\EventsCalendar::factory(),
            'message' => $this->faker->sentence,
            'created_at' => now(),
        ];
    }
}
