<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatepemandusTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemandus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('jenis_kelamin');
            $table->string('nomor_tlp');
            $table->string('longitude');
            $table->string('latitude');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pemandus');
    }
}
