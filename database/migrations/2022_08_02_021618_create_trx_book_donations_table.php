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
            $table->string('isbn');
            $table->string('judul');
            $table->string('penulis');//
            $table->string('penerbit');//
            $table->string('image')->nullable();
            $table->string('kategori');//
            $table->date('tglTerbit');//
            $table->date('tglMasuk');//
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
        Schema::dropIfExists('trx_book_donations');
    }
};