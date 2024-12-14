<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalKegiatanLuarKantorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_kegiatan_luar_kantor', function (Blueprint $table) {
            $table->id();
            $table->datetime('timestamp')->nullable();
            $table->string('persetujuan')->nullable();
            $table->string('arahan')->nullable();
            $table->integer('kegiatan_luar_kantor_id')->nullable();
            $table->string('position')->nullable();
            $table->string('role_to_name')->nullable();
            $table->integer('role_to_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
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
        Schema::dropIfExists('approval_kegiatan_luar_kantor');
    }
}
