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
        Schema::create('trx_donations', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sumbangan');
            $table->integer('member_id');
            $table->string('staff_approved')->nullable();
            $table->string('status')->nullable();
            $table->string('diambil')->nullable();
            $table->date('tanggal_serah_terima')->nullable();
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
        Schema::dropIfExists('item_book_donation');
    }
};
