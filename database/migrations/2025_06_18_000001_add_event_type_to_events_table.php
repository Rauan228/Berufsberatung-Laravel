<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events_calendar', function (Blueprint $table) {
            $table->enum('event_type', ['open', 'closed', 'group'])->default('open')->after('event_date');
        });
    }

    public function down()
    {
        Schema::table('events_calendar', function (Blueprint $table) {
            $table->dropColumn('event_type');
        });
    }
}; 