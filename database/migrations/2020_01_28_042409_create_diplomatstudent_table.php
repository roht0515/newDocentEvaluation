<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomatstudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diplomatstudent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idStudent')->unsigned();
            $table->bigInteger('idDiplomat')->unsigned();
            $table->timestamps();
            $table->foreign('idStudent')->references('id')->on('diplomat');
            $table->foreign('idDiplomat')->references('id')->on('student');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diplomatstudent');
    }
}
