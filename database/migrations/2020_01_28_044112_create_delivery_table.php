<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idSecretary')->unsigned();
            $table->bigInteger('idCertificate')->unsigned();
            $table->dateTime('deliveryDate');
            $table->boolean('recivedTrained')->default(0);
            $table->timestamps();
            $table->foreign('idSecretary')->references('id')->on('secretary');
            $table->foreign('idCertificate')->references('id')->on('certificate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery');
    }
}
