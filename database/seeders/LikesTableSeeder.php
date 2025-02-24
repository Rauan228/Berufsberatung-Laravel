<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LikesTableSeeder extends Seeder
{
    /**
     * Запуск сидера.
     */
    public function run()
    {
        $likes = [];

        for ($i = 1; $i <= 5; $i++) {
            $randomDate = Carbon::now()
                ->subDays(rand(0, 365))
                ->subHours(rand(0, 23))
                ->subMinutes(rand(0, 59))
                ->subSeconds(rand(0, 59));

            $likes[] = [
                'user_id'        => rand(1, 40), // случайный пользователь от 1 до 40
                'institution_id' => rand(1, 18), // случайное учреждение от 1 до 18
                'created_at'     => $randomDate,
                'updated_at'     => $randomDate,
            ];
        }

        DB::table('likes')->insert($likes);
    }
}
