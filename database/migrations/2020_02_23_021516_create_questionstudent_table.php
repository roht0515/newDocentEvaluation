<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionstudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionstudent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idEvaluationStudent')->unsigned();
            $table->bigInteger('idQuestion')->unsigned();
            $table->integer('score');
            $table->timestamps();
            $table->foreign('idEvaluationStudent')->references('id')->on('evaluationstudent');
            $table->foreign('idQuestion')->references('id')->on('question');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionstudent');
    }
}
