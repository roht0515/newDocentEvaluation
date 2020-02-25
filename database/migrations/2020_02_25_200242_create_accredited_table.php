<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('ci');
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('relationship');
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
        Schema::dropIfExists('accredited');
    }
}
