<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmergenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->string('identification')->nullable();
            $table->string('reason')->nullable();
            $table->text('background')->nullable();
            $table->text('ta')->nullable();
            $table->text('fc')->nullable();
            $table->text('fr')->nullable();
            $table->text('temp')->nullable();
            $table->text('physical_exam')->nullable();
            $table->text('observations')->nullable();
            $table->text('laboratory')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('plan')->nullable();
            $table->text('medicine')->nullable();
            $table->text('details')->nullable();
            $table->text('transfer')->nullable();
            $table->enum('status',['Atendiendo','Atendida'])->default('Atendiendo');
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
        Schema::dropIfExists('emergencies');
    }
}
