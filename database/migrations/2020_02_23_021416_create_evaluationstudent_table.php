<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigInteger('idEvaluationModule')->unsigned();
            $table->bigInteger('idStudent')->unsigned();
            $table->boolean('resolved')->default(0);
            $table->bigInteger('score')->nullable();
            $table->dateTime('dateResolved')->nullable();
            $table->timestamps();
            $table->foreign('idEvaluationModule')->references('id')->on('evaluationmodule');
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
