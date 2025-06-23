<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('specializations', function (Blueprint $table) {
            $table->text('about1')->nullable()->after('description');
            $table->text('about2')->nullable()->after('about1');
            $table->text('about3')->nullable()->after('about2');
        });
    }

    public function down()
    {
        Schema::table('specializations', function (Blueprint $table) {
            $table->dropColumn(['about1', 'about2', 'about3']);
        });
    }
}; 