<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_status', function (Blueprint $table) {
            $table->id();
            $table->integer('status_0');    //draft
            $table->integer('status_1');    //belum di approved
            $table->integer('status_2');    //sudah di approved
            $table->integer('status_8');    //ditolak
            $table->integer('status_9');    //dihapus
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
        //
    }
};
