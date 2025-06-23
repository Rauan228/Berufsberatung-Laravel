<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            if (!Schema::hasColumn('institutions', 'grants')) {
            $table->boolean('grants')->default(false);
            }
            if (!Schema::hasColumn('institutions', 'dormitory')) {
            $table->boolean('dormitory')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            if (Schema::hasColumn('institutions', 'grants')) {
                $table->dropColumn('grants');
            }
            if (Schema::hasColumn('institutions', 'dormitory')) {
                $table->dropColumn('dormitory');
            }
        });
    }
};

