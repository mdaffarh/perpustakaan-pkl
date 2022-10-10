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
        Schema::create('tb_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id');//
            $table->integer('stok_awal');
            $table->integer('stok_akhir');
            $table->integer('stok_semua');
            $table->integer('stok_tambahan')->nullable();
            $table->integer('stok_keluar')->nullable();
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
        Schema::dropIfExists('tb_stocks');
    }
};