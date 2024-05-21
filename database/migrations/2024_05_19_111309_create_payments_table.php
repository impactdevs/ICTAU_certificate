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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_no')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('payment_mode');
            $table->string('amount');
            $table->string('balance')->default('0');
            $table->string('payment_of')->nullable();
            $table->string('received_by')->nullable();
            $table->string('cheque_no')->default('N/A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
