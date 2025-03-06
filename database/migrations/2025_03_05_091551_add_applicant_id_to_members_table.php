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
        Schema::table('members', function (Blueprint $table) {
             // Add applicant_id column
             $table->uuid('applicant_id')->nullable()->after('membership_id'); // Make sure the column is placed correctly
            
             // Create a foreign key relationship with applicants table
             $table->foreign('applicant_id')->references('application_id')->on('applicants')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
                        // Drop the foreign key and column in the down method
                        $table->dropForeign(['applicant_id']);
                        $table->dropColumn('applicant_id');
        });
    }
};
