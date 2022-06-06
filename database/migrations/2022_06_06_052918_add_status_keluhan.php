<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusKeluhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keluhan', function (Blueprint $table) {
            //
            $table->string('status')->after('deskripsi');
            $table->date('tanggal')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keluhan', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('tanggal');
        });
    }
}
