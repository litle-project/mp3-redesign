<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLembursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lemburs', function (Blueprint $table) {
            $table->id();
            $table->string('perihal_lembur')->nullable();
            $table->string('rencana_output_kerja_lembur')->nullable();
            $table->date('tanggal_lembur')->nullable();
            $table->string('dari_jam')->nullable();
            $table->string('sampai_jam')->nullable();
            $table->string('total_jam')->nullable();
            $table->string('nomor_perintah_lembur')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('lemburs');
    }
}
