<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigInteger('idAccredited')->unsigned();
            $table->dateTime('deliveryDate');
            $table->boolean('recivedTrained')->default(0);
            $table->timestamps();
            $table->foreign('idSecretary')->references('id')->on('users');
            $table->foreign('idCertificate')->references('id')->on('certificate');
            $table->foreign('idAccredited')->references('id')->on('accredited');
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
