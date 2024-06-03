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
        Schema::create('academic_documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('application_id');//foreign key
            $table->string('academic_document_type')->nullable();//certificate, diploma, degree, postgraduate, masters, phd
            $table->string('title')->nullable();//name of institution
            $table->string('academic_document_path')->nullable();//path to academic document
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_documents');
    }
};
