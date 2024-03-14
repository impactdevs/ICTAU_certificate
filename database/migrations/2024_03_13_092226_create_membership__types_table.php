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
        Schema::create('membership__types', function (Blueprint $table) {
            $table->id();
            $table->string('membership_type_name');
            $table->timestamps();
        });
    }

    /**hgyyhuyj
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership__types');
    }
};
