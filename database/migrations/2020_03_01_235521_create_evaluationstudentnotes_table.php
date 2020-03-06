<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationstudentnotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluationstudentnotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idCategory')->unsigned();
            $table->bigInteger('idModuleStudent')->unsigned();
            $table->integer('score')->default(0);
            $table->foreign('idCategory')->references('id')->on('category');
            $table->foreign('idModuleStudent')->references('id')->on('modulestudent');
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
        Schema::dropIfExists('evaluationstudentnotes');
    }
}
