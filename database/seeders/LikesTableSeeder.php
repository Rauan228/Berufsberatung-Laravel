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

        while (count($likes) < 20) {
            $userId = rand(1, 60);
            $institutionId = rand(1, 18);

            // Проверяем, существует ли уже такой лайк
            $exists = DB::table('likes')
                ->where('user_id', $userId)
                ->where('institution_id', $institutionId)
                ->exists();

            if (!$exists) {
                $randomDate = Carbon::now()
                    ->subDays(rand(0, 365))
                    ->subHours(rand(0, 23))
                    ->subMinutes(rand(0, 59))
                    ->subSeconds(rand(0, 59));

                $likes[] = [
                    'user_id'        => $userId,
                    'institution_id' => $institutionId,
                    'created_at'     => $randomDate,
                    'updated_at'     => $randomDate,
                ];
            }
        }

        DB::table('likes')->insert($likes);
    }
}
