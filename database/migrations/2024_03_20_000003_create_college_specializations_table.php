<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('college_specializations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('college_qualification_id')->constrained('college_qualifications')->onDelete('cascade');
            $table->text('description');
            $table->text('about1')->nullable();
            $table->text('about2')->nullable();
            $table->text('about3')->nullable();
            $table->text('requirements')->nullable();
            $table->text('opportunities')->nullable();
            $table->text('skills')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('college_specializations');
    }
}; 