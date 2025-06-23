<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events_calendar', function (Blueprint $table) {
            $table->enum('institution_type', ['university', 'college'])->default('university')->after('institution_id');
        });

        // Синхронизируем institution_type с institutions.type для существующих записей
        \DB::statement("UPDATE events_calendar ec JOIN institutions i ON ec.institution_id = i.id SET ec.institution_type = i.type");
    }

    public function down(): void
    {
        Schema::table('events_calendar', function (Blueprint $table) {
            $table->dropColumn('institution_type');
        });
    }
};