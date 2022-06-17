<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_pegawai', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jadwal_id')->unsigned()->nullable();
            $table->bigInteger('pegawai_id')->unsigned();
            $table->foreign('jadwal_id')->references('id')->on('jadwal');
            $table->foreign('pegawai_id')->references('id')->on('pegawai');
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
        Schema::dropIfExists('jadwal_pegawai');
    }
}
