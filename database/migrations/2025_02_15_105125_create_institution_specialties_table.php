<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('institution_specialties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->onDelete('cascade');
            $table->foreignId('university_specialization_id')->constrained('specializations')->onDelete('cascade');
            $table->decimal('cost', 10, 2)->nullable();
            $table->integer('duration')->nullable();
            $table->timestamps();

            $table->unique(['institution_id', 'university_specialization_id'], 'inst_spec_unique');
        });
    }

    public function down() {
        Schema::dropIfExists('institution_specialties');
    }
};
