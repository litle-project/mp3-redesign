<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersetujuanCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persetujuan_cuti', function (Blueprint $table) {
            $table->id();
            $table->datetime('timestamp');
            $table->integer('pengajuan_cuti_id')->nullable();
            $table->string('position')->nullable();
            $table->string('role_to_name')->nullable();
            $table->integer('role_to_id')->nullable();
            $table->string('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('title')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('persetujuan_cuti');
    }
}
