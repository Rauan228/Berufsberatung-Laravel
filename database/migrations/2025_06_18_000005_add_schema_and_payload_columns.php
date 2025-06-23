<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events_calendar', function (Blueprint $table) {
            $table->json('application_schema')->nullable()->after('event_type');
        });

        Schema::table('user_applications', function (Blueprint $table) {
            $table->json('payload')->nullable()->after('ticket_code');
        });

        Schema::table('group_applications', function (Blueprint $table) {
            $table->json('payload')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('events_calendar', function (Blueprint $table) {
            $table->dropColumn('application_schema');
        });
        Schema::table('user_applications', function (Blueprint $table) {
            $table->dropColumn('payload');
        });
        Schema::table('group_applications', function (Blueprint $table) {
            $table->dropColumn('payload');
        });
    }
}; 