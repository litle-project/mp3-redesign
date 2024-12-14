<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJamIstirahatToAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->string('jam_masuk_istirahat')->nullable();
            $table->string('jam_keluar_istirahat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('absensis', function (Blueprint $table) {
            $table->dropColumn('jam_masuk_istirahat');
            $table->dropColumn('jam_keluar_istirahat');
        });
    }
}
