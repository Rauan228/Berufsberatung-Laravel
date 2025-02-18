<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('institution_specialties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialization_id')->constrained()->onDelete('cascade');
            $table->decimal('cost', 10, 2)->nullable(); // Разрешаем null для столбца cost
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('institution_specialties');
    }
};
