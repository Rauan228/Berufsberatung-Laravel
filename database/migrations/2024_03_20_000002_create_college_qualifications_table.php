<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('college_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('qualification_name');
            $table->foreignId('college_global_specialty_id')->constrained('college_global_specialties')->onDelete('cascade');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('college_qualifications');
    }
}; 