<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description1')->nullable();
            $table->text('description2')->nullable();
            $table->text('description3')->nullable();
            $table->string('location')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('verified')->default('accepted'); // Добавляем поле verified
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};