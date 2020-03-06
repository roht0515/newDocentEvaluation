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
            $table->bigInteger('idModuleStudent')->unsigned();
            $table->dateTime('dateResolved')->nullable();
            $table->boolean('resolved')->default(0);
            $table->integer('score')->default(0);
            $table->timestamps();
            $table->foreign('idModuleStudent')->references('id')->on('modulestudent');
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
