<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('institution_applications', function (Blueprint $table) {
            $table->enum('type', ['university', 'college'])->default('university')->after('institution_name');
        });
    }

    public function down(): void
    {
        Schema::table('institution_applications', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};