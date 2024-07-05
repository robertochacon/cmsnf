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
        Schema::create('cashier_closures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->decimal('amount_start', 10, 2)->nullable();
            $table->decimal('deposit', 10, 2)->nullable();
            $table->decimal('output', 10, 2)->nullable();
            $table->decimal('cash_sale', 10, 2)->nullable();
            $table->decimal('credit_sale', 10, 2)->nullable();
            $table->decimal('cash_purchase', 10, 2)->nullable();
            $table->decimal('buy_credit', 10, 2)->nullable();
            $table->decimal('missing_balance', 10, 2)->nullable();
            $table->decimal('remaining_balance', 10, 2)->nullable();
            $table->decimal('cash_balance', 10, 2)->nullable();
            $table->enum('status', ['Abierta', 'Cerrada'])->default('Abierta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashier_closures');
    }
};
