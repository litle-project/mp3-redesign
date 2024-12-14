<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiDinasLuarKotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_dinas_luar_kota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dinas_luar_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('dinas_luar_id')
            ->references('id')
            ->on('transaksi_dinas_luar_kota')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
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
        Schema::dropIfExists('pegawai_dinas_luar_kota');
    }
}
