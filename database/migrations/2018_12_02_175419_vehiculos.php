<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vehiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('serie');
            $table->string('color');
            $table->string('cilindraje');
            $table->integer('potencia');
            $table->string('peso');
            
            $table->integer('fabricante_id')->unsigned();
            $table->foreign('fabricante_id')->references('id')->on('fabricantes');

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
        Schema::dropIfExists('vehiculos');
    }
}
