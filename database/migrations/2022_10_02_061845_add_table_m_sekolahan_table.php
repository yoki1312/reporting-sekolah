<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableMSekolahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_sekolahan', function (Blueprint $table) {
            $table->increments('id_sekolahan');
            $table->char('nama_sekolahan');
            $table->integer('id_jenjang');
            $table->integer('id_kecamatan');
            $table->integer('id_status_sekolahan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
