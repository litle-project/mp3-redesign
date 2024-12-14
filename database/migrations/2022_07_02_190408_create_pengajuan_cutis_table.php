<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_cutis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_permohonan')->nullable();
            $table->string('perihal_cuti')->nullable();
            $table->date('tanggal_mulai_cuti')->nullable();
            $table->date('tanggal_selesai_cuti')->nullable();
            $table->text('alamat_pemohon')->nullable();
            $table->string('nomor_telepon_darurat')->nullable();
            $table->string('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('total_hari_cuti')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('pengajuan_cutis');
    }
}
