<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiDinasLuarKotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_dinas_luar_kota', function (Blueprint $table) {
            $table->id();
            $table->string('perihal_dinas');
            $table->string('tanggal_mulai_dinas');
            $table->string('tanggal_selesai_dinas');
            $table->string('kota_kedinasan');
            $table->text('alamat_kedinasan');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('keterangan');
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
        Schema::dropIfExists('transaksi_dinas_luar_kota');
    }
}
