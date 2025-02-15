<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GrantsTableSeeder extends Seeder
{
    public function run()
    {
        $grants = [
            [
                'institution_id'       => 1,
                'grant_name'           => 'Государственный образовательный грант',
                'amount'               => 100000.00,
                'application_deadline' => '2025-07-10',
            ],
        ];

        foreach ($grants as &$grant) {
            $grant['created_at'] = Carbon::now()->subDays(rand(10, 90))->subHours(rand(1, 23))->subMinutes(rand(1, 59));
            $grant['updated_at'] = Carbon::now()->subDays(rand(1, 30))->subHours(rand(1, 23))->subMinutes(rand(1, 59));
        }

        DB::table('grants')->insert($grants);
    }
}
