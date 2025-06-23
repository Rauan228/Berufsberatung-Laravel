<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('global_specialties', function (Blueprint $table) {
            // Rename specialty_name to name
            $table->renameColumn('specialty_name', 'name');
            // Add description column
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('global_specialties', function (Blueprint $table) {
            $table->renameColumn('name', 'specialty_name');
            $table->dropColumn('description');
        });
    }
}; 