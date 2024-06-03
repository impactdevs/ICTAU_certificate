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
        Schema::create('contact_persons', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();//given name
            $table->string('last_name')->nullable();//surname
            $table->string('phone_number')->nullable();//Mr, Mrs, Dr, etc
            $table->string('email')->nullable();//email address
            $table->uuid('application_id');//foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_persons');
    }
};
