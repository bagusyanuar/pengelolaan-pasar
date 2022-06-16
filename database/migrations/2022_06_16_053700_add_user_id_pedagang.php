<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdPedagang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedagang', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->after('id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedagang', function (Blueprint $table) {
            $table->dropForeign('pedagang_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
