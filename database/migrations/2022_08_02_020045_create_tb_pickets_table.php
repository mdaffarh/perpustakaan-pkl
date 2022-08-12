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
        Schema::create('tb_pickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->unique();
            $table->boolean('senin');
            $table->boolean('selasa');
            $table->boolean('rabu');
            $table->boolean('kamis');
            $table->boolean('jumat');
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
        Schema::dropIfExists('tb_pickets');
    }
};
