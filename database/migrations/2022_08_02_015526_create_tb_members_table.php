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
            // nis nama jenis_kelamin kelas jurusan tanggal_lahir nomor_telepon alamat
            $table->id();
            $table->bigInteger('nis')->unique();
            $table->string('nama');
            $table->string('jenis_kelamin');//
            $table->string('kelas');//
            $table->string('jurusan');//
            $table->date('tanggal_lahir');
            $table->string('nomor_telepon');
            $table->string('alamat');
            $table->boolean('signed')->nullable();
            $table->boolean('status');
            $table->string('profile')->nullable(); 
            $table->timestamps();
            $table->foreignId('created_by');
            $table->foreignId('updated_by');
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