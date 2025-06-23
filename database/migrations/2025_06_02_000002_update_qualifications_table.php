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
        Schema::table('qualifications', function (Blueprint $table) {
            // Rename specialty_id to global_specialty_id
            $table->renameColumn('specialty_id', 'global_specialty_id');
            // Add description column
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('qualifications', function (Blueprint $table) {
            $table->renameColumn('global_specialty_id', 'specialty_id');
            $table->dropColumn('description');
        });
    }
}; 