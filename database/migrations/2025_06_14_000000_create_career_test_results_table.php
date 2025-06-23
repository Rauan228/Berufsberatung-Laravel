<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('career_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('institution_type', ['college', 'university']);
            $table->json('answers'); // сохранённые ответы пользователя
            $table->text('summary')->nullable(); // текстовое описание профиля
            $table->json('suggestions')->nullable(); // массив id спец. из таблиц (college_specializations|specializations)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('career_test_results');
    }
}; 