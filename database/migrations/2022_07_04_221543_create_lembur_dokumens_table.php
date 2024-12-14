<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLemburDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur_dokumens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lembur_id')->nullable();
            $table->string('dokumen')->nullable();
            $table->foreign('lembur_id')->references('id')->on('lemburs')->onDelete('cascade');
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
        Schema::dropIfExists('lembur_dokumens');
    }
}
