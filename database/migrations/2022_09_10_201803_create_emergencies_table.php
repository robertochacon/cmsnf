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
            $table->string('name')->nullable();
            $table->string('reason')->nullable();
            $table->longText('background')->nullable();
            $table->text('ta')->nullable();
            $table->text('fc')->nullable();
            $table->text('fr')->nullable();
            $table->text('temp')->nullable();
            $table->longText('physical_exam')->nullable();
            $table->longText('observations')->nullable();
            $table->longText('laboratory')->nullable();
            $table->longText('diagnosis')->nullable();
            $table->longText('plan')->nullable();
            $table->longText('medicine')->nullable();
            $table->longText('details')->nullable();
            $table->longText('pending')->nullable();
            $table->text('hospital_transfer')->nullable();
            $table->longText('reason_transfer')->nullable();
            $table->enum('status',['Atendiendo','Atendida','Traslado'])->default('Atendiendo');
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
