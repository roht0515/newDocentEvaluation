<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulestudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulestudent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idModule')->unsigned();
            $table->bigInteger('idStudent')->unsigned();
            $table->string('group');
            $table->string('classroomNumber');
            $table->timestamps();
            $table->foreign('idModule')->references('id')->on('module');
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
        Schema::dropIfExists('modulestudent');
    }
}
