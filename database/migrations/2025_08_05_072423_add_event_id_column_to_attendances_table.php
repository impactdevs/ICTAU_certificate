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
        // Ensure the table exists
        if (Schema::hasTable('attendances')) {
            Schema::table('attendances', function (Blueprint $table) {
                if (!Schema::hasColumn('attendances', 'event_id')) {
                    $table->uuid('event_id')->after('id')->nullable();

                    // Add foreign key constraint
                    $table->foreign('event_id')
                        ->references('event_id')
                        ->on('events')
                        ->onDelete('cascade');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('attendances')) {
            Schema::table('attendances', function (Blueprint $table) {
                if (Schema::hasColumn('attendances', 'event_id')) {
                    $table->dropForeign(['event_id']);
                    $table->dropColumn('event_id');
                }
            });
        }
    }
};
