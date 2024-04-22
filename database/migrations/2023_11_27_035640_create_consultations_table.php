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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->string('ta')->nullable();
            $table->string('fc')->nullable();
            $table->string('fr')->nullable();
            $table->string('reason')->nullable();
            $table->longText('counter_referral')->nullable();
            $table->longText('hea')->nullable();
            $table->longText('physical_exam')->nullable();
            $table->longText('diagnosis')->nullable();
            $table->longText('treatment')->nullable();
            $table->longText('complementary_studies')->nullable();
            $table->longText('note')->nullable();
            $table->enum('status',['Pendiente','Completada'])->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
