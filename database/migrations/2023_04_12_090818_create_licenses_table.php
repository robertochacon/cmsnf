<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name')->nullable();
            $table->string('identification')->unique();
            $table->string('range')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('days')->nullable();
            $table->longText('diagnostic')->unique();
            $table->date('date_start')->unique();
            $table->date('date_end')->unique();
            $table->enum('status',['Recibida','Aprobada','Rechazada'])->default('Recibida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licenses');
    }
}
