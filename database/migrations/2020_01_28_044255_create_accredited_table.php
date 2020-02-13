<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccreditedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accredited', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idDelivery')->unsigned();
            $table->string('ci');
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('relationship');
            $table->timestamps();
            $table->foreign('idDelivery')->references('id')->on('delivery');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accredited');
    }
}
