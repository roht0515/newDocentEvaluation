<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecretaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secretary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idUser')->unsigned();
            $table->string('ci');
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->bigInteger('phone');
            $table->string('address');
            $table->dateTime('timeEntry');
            $table->dateTime('startTime');
            $table->dateTime('endTime');
            $table->timestamps();
            $table->foreign('idUser')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('secretary');
    }
}
