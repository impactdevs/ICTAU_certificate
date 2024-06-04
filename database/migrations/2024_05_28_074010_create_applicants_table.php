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
        Schema::create('applicants', function (Blueprint $table) {
            $table->uuid('application_id')->primary();//unique identifier
            $table->string('curriculum_vitae')->nullable();//path to CV
            $table->string('phone_number')->unique();//phone number
            $table->string('email')->unique();//email address
            $table->string('first_name')->nullable();//given name
            $table->string('last_name')->nullable();//surname
            $table->string('institution')->nullable();//institution
            $table->string('course')->nullable();//degree
            $table->string('title')->nullable();//Mr, Mrs, Dr, etc
            $table->string('company_name')->nullable();//if applicant is a company
            $table->string('company_website')->nullable();//if applicant is a company
            $table->string('niche')->nullable();//Software Development, Marketing, etc
            $table->string('application_category')->nullable();//student/professional/company
            $table->string('date_of_birth')->nullable();//date of birth
            $table->string('profession')->nullable();//profession
            $table->string('application_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
