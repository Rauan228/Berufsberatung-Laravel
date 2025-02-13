<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('notifications')->insert([
            [
                'event_id'   => 1,
                'message'    => 'You have been accepted to the Tech Career Fair.',
                'user_id'    => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
