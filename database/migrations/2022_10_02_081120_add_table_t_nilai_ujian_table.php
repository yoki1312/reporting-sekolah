<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableTNilaiUjianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_nilai_ujian', function (Blueprint $table) {
            $table->increments('id_nilai_ujian');
            $table->integer('id_user')->nullable()->default(0);
            $table->integer('id_kategori_ujian')->nullable()->default(0);
            $table->integer('jumlah_soal')->nullable()->default(0);
            $table->integer('jumlah_benar')->nullable()->default(0);
            // $table->char('nama_kecamatan');
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
