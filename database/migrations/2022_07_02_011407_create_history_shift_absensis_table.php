<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryShiftAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_shift_absensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_shift')->nullable();
            $table->string('jam_masuk')->nullable();
            $table->string('jam_pulang')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('instalasi_id')->nullable();
            $table->unsignedBigInteger('absensi_id')->nullable();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('instalasi_id')
            ->references('id')
            ->on('instalasis')
            ->onDelete('cascade');

            $table->foreign('absensi_id')
            ->references('id')
            ->on('absensis')
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
        Schema::dropIfExists('history_shift_absensis');
    }
}
