<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('institution_specialties', function (Blueprint $table) {
            $table->integer('duration')->nullable()->after('cost'); // Добавляем срок обучения
        });
    }

    public function down() {
        Schema::table('institution_specialties', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
};

