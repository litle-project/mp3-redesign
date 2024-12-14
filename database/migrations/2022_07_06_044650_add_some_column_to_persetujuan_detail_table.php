<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToPersetujuanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persetujuan_cuti_detail', function (Blueprint $table) {
            $table->string("permasalahan_administrasi_akibatcuti")->nullable();
            $table->text("permasalahan_administrasi_akibatcuti_keterangan")->nullable();
            $table->text("arahan")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persetujuan_cuti_detail', function (Blueprint $table) {
            $table->dropColumn("permasalahan_administrasi_akibatcuti")->nullable();
            $table->dropColumn("permasalahan_administrasi_akibatcuti_keterangan")->nullable();
            $table->text("arahan")->nullable();
        });
    }
}
