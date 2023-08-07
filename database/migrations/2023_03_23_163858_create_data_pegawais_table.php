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
        Schema::create('data_pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('pas_foto');
            $table->string('nama_lengkap');
            $table->string('no_hp');
            $table->string('email')->unique();
            $table->string('nip')->unique();
            $table->foreignId('role_id');
            $table->string('pangkat_gol');
            $table->string('alamat_rumah');
            $table->string('ttl');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('status_perkawinan');
            $table->string('pendidikan_terakhir');
            $table->string('nik')->unique();
            $table->string('ktp');
            $table->string('npwp');
            $table->string('sim_a')->nullable();
            $table->string('sim_b')->nullable();
            $table->string('sim_c');
            $table->string('paspor')->nullable();
            $table->string('is_active');
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
        Schema::dropIfExists('data_pegawais');
    }
};
