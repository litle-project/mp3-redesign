<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTambahJamKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tambah_jam_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->integer('kegiatan_luar_kantor_id')->nullable();
            $table->integer('tambahan_jam')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('status')->nullable();
            $table->string('role_to_name')->nullable();
            $table->integer('role_to_id')->nullable();
            $table->integer('approve_by')->nullable();
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
        Schema::dropIfExists('tambah_jam_kegiatan');
    }
}
