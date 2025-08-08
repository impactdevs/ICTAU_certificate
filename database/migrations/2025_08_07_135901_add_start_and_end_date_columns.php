<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('event_date');
            $table->date('end_date')->nullable()->after('start_date');
        });

        // drop event_date column
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'end_date']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->string('event_date')->after('venue_name');
        });
    }
};
