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
        Schema::create('grants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained('institutions')->onDelete('cascade');
            $table->string('grant_name');
            $table->decimal('amount', 10, 2);
            $table->date('application_deadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grants');
    }
};
