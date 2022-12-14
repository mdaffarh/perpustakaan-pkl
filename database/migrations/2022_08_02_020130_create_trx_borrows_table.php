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
            $table->string('kode_peminjaman');
            $table->foreignId('member_id');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_tempo');
            $table->string('status');
            $table->string('pengambilan_buku');
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