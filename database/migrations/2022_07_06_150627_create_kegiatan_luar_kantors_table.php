<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanLuarKantorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_luar_kantor', function (Blueprint $table) {
            $table->id();
            $table->datetime('timestamp')->nullable();
            $table->string('nomor_surat')->nullable();
            $table->string('tanggal_kegiatan')->nullable();
            $table->string('perihal')->nullable();
            $table->string('personil_yang_ditugaskan')->nullable();
            $table->string('urgensi')->nullable();
            $table->string('jam_mulai_kegiatan')->nullable();
            $table->string('jam_selesai_kegiatan')->nullable();
            $table->string('entitas')->nullable();
            $table->text('entitas_alamat')->nullable();
            $table->integer('user_id')->nullable();
            $table->float('total_jam')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('kegiatan_luar_kantor');
    }
}
