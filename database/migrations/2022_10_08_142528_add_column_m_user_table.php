<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_user', function (Blueprint $table) {
            $table->char('status_pegawai')->nullable();
            $table->char('id_user_old')->nullable();
            $table->char('username')->nullable();
            $table->char('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_user', function (Blueprint $table) {
            //
        });
    }
}
