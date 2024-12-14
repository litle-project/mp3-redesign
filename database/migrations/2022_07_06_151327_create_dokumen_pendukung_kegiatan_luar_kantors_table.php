<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenPendukungKegiatanLuarKantorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_pendukung_kegiatan_luar_kantor', function (Blueprint $table) {
            $table->id();
            $table->integer('kegiatan_luar_kantor_id');
            $table->integer('user_id');
            $table->string('original_file_name');
            $table->string('file_name');
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
        Schema::dropIfExists('dokumen_pendukung_kegiatan_luar_kantor');
    }
}
