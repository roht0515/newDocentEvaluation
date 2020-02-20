<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationmoduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluationmodule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idEvaluation')->unsigned();
            $table->bigInteger('idModule')->unsigned()->unique();
            $table->timestamps();
            $table->foreign('idEvaluation')->references('id')->on('evaluation');
            $table->foreign('idModule')->references('id')->on('module');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluationmodule');
    }
}
