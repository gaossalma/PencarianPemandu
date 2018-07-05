<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Createbahasa_pemandusTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahasa_pemandus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pemandu')->unsigned();
            $table->integer('id_bahasa')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_pemandu')->references('id')->on('pemandus');
            $table->foreign('id_bahasa')->references('id')->on('bahasas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bahasa_pemandus');
    }
}
