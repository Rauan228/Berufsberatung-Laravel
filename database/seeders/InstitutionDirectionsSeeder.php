<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionDirectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Возможные направления обучения
        $directionsOptions = [
            'Техническое',
            'Гуманитарное',
            'Медицина',
            'IT',
            'Юриспруденция',
            'Искусство',
        ];

        // Получаем все учреждения и обновляем поле directions случайным значением
        $institutionIds = DB::table('institutions')->pluck('id');

        foreach ($institutionIds as $id) {
            DB::table('institutions')->where('id', $id)->update([
                'directions' => $directionsOptions[array_rand($directionsOptions)],
            ]);
        }
    }
} 