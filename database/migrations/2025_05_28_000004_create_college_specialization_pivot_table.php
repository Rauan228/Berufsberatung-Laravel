<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('college_institution_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->foreignId('college_specialization_id')
                  ->constrained('college_specializations')
                  ->onDelete('cascade');
            $table->decimal('cost', 10, 2)->nullable();
            $table->string('duration')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('college_institution_specs');
    }
}; 