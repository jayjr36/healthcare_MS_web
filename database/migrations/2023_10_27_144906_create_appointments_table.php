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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();           
            $table->unsignedBigInteger('patient_id'); // Use unsignedBigInteger to match 'id' in 'users'
            $table->unsignedBigInteger('doctor_id'); // Similarly for 'doctor_id'
            $table->string('date');
            $table->string('day');
            $table->string('time');
            $table->string('status');
            
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
