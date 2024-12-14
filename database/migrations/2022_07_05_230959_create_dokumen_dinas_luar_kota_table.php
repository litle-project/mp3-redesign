<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenDinasLuarKotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_dinas_luar_kota', function (Blueprint $table) {
            $table->id();
            $table->string('filename')->nullable();
            $table->unsignedBigInteger('dinas_luar_id')->nullable();

            $table->foreign('dinas_luar_id')
            ->references('id')
            ->on('transaksi_dinas_luar_kota')
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
        Schema::dropIfExists('dokumen_dinas_luar_kota');
    }
}
