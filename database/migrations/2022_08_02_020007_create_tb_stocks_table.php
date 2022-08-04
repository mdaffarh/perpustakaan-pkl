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
            $table->foreignId('book_id')->unique();
            $table->integer('stock');
            $table->integer('initial_stock');
            $table->date('borrow_date');
            $table->integer('end_stock');
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
