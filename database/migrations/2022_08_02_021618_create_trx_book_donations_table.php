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
            $table->foreignId('member_id')->unique();
            $table->string('judul');
            $table->string('penulis');//
            $table->string('penerbit');//
            $table->string('kategori');//
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
        Schema::dropIfExists('trx_book_donations');
    }
};
