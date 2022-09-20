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
        Schema::create('trx_book_donations', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->nullable();
            $table->string('isbn');
            $table->string('judul');
            $table->string('penulis');//
            $table->string('penerbit');
            $table->string('stock_awal');
            $table->string('image')->nullable();
            $table->string('staff_approved')->nullable();
            $table->string('status')->nullable();
            $table->string('diambil')->nullable();
            $table->integer('staffygngambil')->nullable();
            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_book_donations');
    }
};