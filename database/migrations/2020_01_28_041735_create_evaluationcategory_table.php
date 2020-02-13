<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluationcategory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idCategory')->unsigned();
            $table->bigInteger('idEvaluation')->unsigned();
            $table->timestamps();
            $table->foreign('idCategory')->references('id')->on('category');
            $table->foreign('idEvaluation')->references('id')->on('evaluation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluationcategory');
    }
}
