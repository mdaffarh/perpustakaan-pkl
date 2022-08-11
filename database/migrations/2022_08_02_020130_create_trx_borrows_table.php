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
        Schema::create('trx_borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->unique();
            $table->foreignId('book_id')->unique();
            $table->foreignId('staff_id')->unique();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_tempo');
            $table->foreignId('school_id')->unique();
            $table->text('deskripsi');
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_borrows');
    }
};
