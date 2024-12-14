<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable();
            $table->string('nip')->nullable();
            $table->string('nik')->nullable();
            $table->string('npwp')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('status_pegawai')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat_ktp')->nullable();
            $table->text('alamat_tinggal')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username')->unique()->nullable();
            $table->dropColumn('nip')->nullable();
            $table->dropColumn('nik')->nullable();
            $table->dropColumn('npwp')->nullable();
            $table->dropColumn('jenis_kelamin')->nullable();
            $table->dropColumn('status_pegawai')->nullable();
            $table->dropColumn('tempat_lahir')->nullable();
            $table->dropColumn('tanggal_lahir')->nullable();
            $table->dropColumn('alamat_ktp')->nullable();
            $table->dropColumn('alamat_tinggal')->nullable();
            $table->dropColumn('latitude')->nullable();
            $table->dropColumn('longitude')->nullable();
            $table->dropColumn('nomor_telepon')->nullable();
            $table->dropColumn('foto')->nullable();
        });
    }
}
