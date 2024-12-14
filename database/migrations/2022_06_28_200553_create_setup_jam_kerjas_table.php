<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetupJamKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setup_jam_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('jam_masuk');
            $table->string('jam_pulang');
            $table->string('jam_masuk_istirahat');
            $table->string('jam_keluar_istirahat');
            $table->text('keterangan');
            $table->unsignedBigInteger('instalasi_id');

            $table->foreign('instalasi_id')
                ->references('id')
                ->on('instalasis')
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
        Schema::dropIfExists('setup_jam_kerjas');
    }
}
