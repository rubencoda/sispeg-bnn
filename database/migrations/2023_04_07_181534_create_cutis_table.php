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
        Schema::create('cutis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nip');
            $table->string('nama_pegawai');
            $table->string('jabatan');
            $table->foreignId('jenis_cuti');
            $table->string('catatan_cuti')->nullable();
            $table->date('mulai_cuti')->nullable();
            $table->date('akhir_cuti')->nullable();
            $table->string('alamat_cuti');
            $table->string('status_cuti');
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
        Schema::dropIfExists('cutis');
    }
};
