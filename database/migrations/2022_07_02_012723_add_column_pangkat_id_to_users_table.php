<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPangkatIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('pangkat_id')->nullable();
            $table->foreign('pangkat_id')
            ->references('id')
            ->on('pangkats')
            ->onDelete('cascade');
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
            $table->unsignedBigInteger('pangkat_id')->nullable();
            $table->foreign('pangkat_id')
            ->references('id')
            ->on('pangkats')
            ->onDelete('cascade');
        });
    }
}
