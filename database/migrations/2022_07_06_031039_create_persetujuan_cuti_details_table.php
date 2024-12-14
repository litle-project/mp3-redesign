<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersetujuanCutiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persetujuan_cuti_detail', function (Blueprint $table) {
            $table->id();
            $table->datetime("timestamp")->nullable();
            $table->integer("persetujuan_cuti_id")->nullable();
            $table->integer("pengajuan_cuti_id")->nullable();

            $table->string("status")->nullable();
            $table->string("pertimbangan_disiplin")->nullable();
            $table->text("pertimbangan_disiplin_keterangan")->nullable();
            $table->string("pekerjaan_terhambat")->nullable();
            $table->string("pekerjaan_terhambat_keterangan")->nullable();
            $table->string("pekerjaan_terhambat_solusi")->nullable();
            $table->string("penunjukkan_pelaksana_harian")->nullable();
            $table->integer("penunjukkan_pelaksana_harian_id")->nullable();
            $table->string("keterangan")->nullable();
            $table->integer("user_id")->nullable();

            $table->string("type")->nullable();

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
        Schema::dropIfExists('persetujuan_cuti_details');
    }
}
