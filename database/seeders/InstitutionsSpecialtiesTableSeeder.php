<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InstitutionsSpecialtiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('institution_specialties')->insert([
            [
                'specialty_id'   => 1,
                'specialty_name' => 'Software Engineering',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);
    }
}
