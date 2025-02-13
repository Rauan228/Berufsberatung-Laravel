<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApplicationsTableSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['Accepted', 'Rejected', 'Pending'];
        $applications = [];

        for ($i = 0; $i < 300; $i++) {
            $applications[] = [
                'user_id'    => rand(1, 40),
                'event_id'   => rand(1, 40),
                'status'     => $statuses[array_rand($statuses)], // случайный статус
                'created_at' => Carbon::now()->subDays(rand(1, 30))->subHours(rand(1, 23))->subMinutes(rand(1, 59)),
                'updated_at' => Carbon::now()->subDays(rand(1, 30))->subHours(rand(1, 23))->subMinutes(rand(1, 59)),
            ];
        }

        DB::table('applications')->insert($applications);
    }
}
