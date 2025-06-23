<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Проверяем существование таблицы перед обновлением
        if (Schema::hasTable('college_institution_specs')) {
            DB::table('institutions')
                ->whereIn('id', function($query) {
                    $query->select('institution_id')
                        ->from('college_institution_specs')
                        ->distinct();
                })
                ->update(['type' => 'college']);
        }
    }

    public function down()
    {
        // При откате просто устанавливаем все типы обратно в university
        DB::table('institutions')
            ->where('type', 'college')
            ->update(['type' => 'university']);
    }
}; 