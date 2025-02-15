<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InstitutionSpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutions = DB::table('institutions')->pluck('id');
        $specialties = DB::table('specializations')->pluck('id');

        if ($institutions->isEmpty() || $specialties->isEmpty()) {
            Log::warning('Institutions or specialties table is empty. Seeder aborted.');
            return;
        }

        $data = [];
        foreach ($institutions as $institutionId) {
            $assignedSpecialties = $specialties->random(rand(1, 3)); 
            foreach ($assignedSpecialties as $specialtyId) {
                $data[] = [
                    'institution_id' => $institutionId,
                    'specialization_id' => $specialtyId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('institution_specialties')->insert($data);
    }
}
 