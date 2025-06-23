<?php

namespace Database\Seeders;

use App\Models\CareerTestResult;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TestResultsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Убедимся, что есть хотя бы несколько пользователей
        if (User::count() === 0) {
            User::factory()->count(10)->create();
        }

        $users = User::inRandomOrder()->take(20)->get();

        foreach ($users as $user) {
            $date = Carbon::now()->subDays(fake()->numberBetween(0, 6))
                ->subHours(fake()->numberBetween(0, 23))
                ->subMinutes(fake()->numberBetween(0, 59));

            DB::table('career_test_results')->insert([
                'user_id'          => $user->id,
                'institution_type' => fake()->randomElement(['university', 'college']),
                'answers'          => json_encode(array_fill(0, 80, fake()->numberBetween(1, 5))),
                'summary'          => fake()->paragraph(3, true),
                'suggestions'      => json_encode([
                    ['name' => fake()->jobTitle()],
                    ['name' => fake()->jobTitle()],
                    ['name' => fake()->jobTitle()],
                ]),
                'created_at'       => $date,
                'updated_at'       => $date,
            ]);
        }
    }
} 