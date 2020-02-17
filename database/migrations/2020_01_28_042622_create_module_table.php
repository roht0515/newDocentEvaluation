<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idProfessor')->unsigned();
            $table->bigInteger('idDiplomat')->unsigned();
            $table->string('name');
            $table->integer('number');
            $table->string('turn');
            $table->date('startDate');
            $table->date('endDate');
            $table->time('startTime');
            $table->time('endTime');
            $table->timestamps();
            $table->foreign('idProfessor')->references('id')->on('professor');
            $table->foreign('idDiplomat')->references('id')->on('diplomat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module');
    }
}
