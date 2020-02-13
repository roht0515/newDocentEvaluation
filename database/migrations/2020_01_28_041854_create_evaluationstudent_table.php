<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationstudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluationstudent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idEvaluation')->unsigned();
            $table->bigInteger('idStudent')->unsigned();
            $table->boolean('resolved')->default(0);
            $table->bigInteger('score');
            $table->timestamps();
            $table->foreign('idEvaluation')->references('id')->on('evaluation');
            $table->foreign('idStudent')->references('id')->on('student');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluationstudent');
    }
}
