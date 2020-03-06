<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationdiplomatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluationdiplomat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idEvaluation')->unsigned();
            $table->bigInteger('idDiplomat')->unsigned();
            $table->timestamps();
            $table->foreign('idEvaluation')->references('id')->on('evaluation');
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
        Schema::dropIfExists('evaluationdiplomat');
    }
}
