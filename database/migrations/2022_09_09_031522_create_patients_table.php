<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('sexo')->nullable();
            $table->unsignedBigInteger('institution_id')->nullable();
            $table->boolean('military')->default(true);
            $table->string('name')->nullable();
            $table->string('identification')->unique();
            $table->string('range')->nullable();
            $table->string('age')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('blood')->nullable();
            $table->json('military_family')->nullable();
            $table->json('history')->nullable();
            $table->enum('status',['Activo','Inactivo'])->default('Activo');
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
        Schema::dropIfExists('patients');
    }
}
