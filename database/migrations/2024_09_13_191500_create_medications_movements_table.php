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
        Schema::create('medications_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medication_id')->nullable();
            $table->foreign('medication_id')->references('id')->on('medications');
            $table->integer('quantity')->nullable();
            $table->enum('status', ['inbound','outgoing'])->nullable()->default('inbound');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medications_movements');
    }
};
