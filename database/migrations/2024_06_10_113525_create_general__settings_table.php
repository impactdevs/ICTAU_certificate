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
        Schema::create('general__settings', function (Blueprint $table) {
            $table->id();
            $table->double('send_certificate_after')->default('1.5');
            $table->double('send_welcome_email_after')->default('1.5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general__settings');
    }
};
