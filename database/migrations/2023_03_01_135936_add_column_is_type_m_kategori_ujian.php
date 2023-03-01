<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsTypeMKategoriUjian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_kategori_ujian', function (Blueprint $table) {
            $table->integer('is_type')->nullable()->default(0)->after('id_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_kategori_ujian', function (Blueprint $table) {
            //
        });
    }
}
