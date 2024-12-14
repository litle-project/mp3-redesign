<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLemburUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lembur_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('lembur_id')->references('id')->on('lemburs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('lembur_users');
    }
}
