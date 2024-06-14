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
       
    Schema::create('doctor_details', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('doctor_id')->unique(); // Use unsignedBigInteger for consistency with 'id' in 'users'
        $table->string('category')->nullable();
        $table->unsignedInteger('patients')->nullable();
        $table->unsignedInteger('experience')->nullable();
        $table->longText('bio_data')->nullable();
        $table->string('status')->nullable();
        $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_details');
    }
};
