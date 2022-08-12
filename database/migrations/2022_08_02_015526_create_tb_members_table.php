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
        Schema::create('tb_members', function (Blueprint $table) {
            $table->id();
            $table->integer('nis')->unique();
            $table->string('nama');
            $table->boolean('jenis_kelamin');//
            $table->string('kelas');//
            $table->string('jurusan');//
            $table->date('tanggal_lahir');
            $table->string('nomor_telepon');
            $table->string('alamat');
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
        Schema::dropIfExists('tb_members');
    }
};
