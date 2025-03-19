<?php

namespace Database\Factories;

use App\Models\EventsCalendar;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventsCalendarFactory extends Factory
{
    protected $model = EventsCalendar::class;

    public function definition()
    {
        return [
            'institution_id' => Institution::factory(),
            'event_name' => $this->faker->word,
            'event_date' => $this->faker->dateTimeThisYear,
            'description' => $this->faker->paragraph,
        ];
    }
}
