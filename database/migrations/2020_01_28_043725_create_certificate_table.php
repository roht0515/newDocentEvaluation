<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idTrained')->unsigned();
            $table->string('name');
            $table->string('type');
            $table->string('reason');
            $table->boolean('delivered')->default(0);
            $table->date('dateMade');
            $table->timestamps();
            $table->foreign('idTrained')->references('id')->on('trained');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificate');
    }
}
