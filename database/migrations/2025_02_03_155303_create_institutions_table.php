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
            $table->string('address')->nullable(); // Добавляем адрес
            $table->decimal('latitude', 16, 14)->nullable(); // Добавляем широту (10 знаков, 7 после запятой)
            $table->decimal('longitude', 16,14)->nullable(); // Добавляем долготу
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('verified')->default('pending'); 
            $table->string('logo_url')->nullable(); 
            $table->string('photo_url')->nullable(); 
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
