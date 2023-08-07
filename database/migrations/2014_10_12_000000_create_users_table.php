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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->dateTime('check_in_today')->default('1999-05-01 00:00:00');
            $table->dateTime('check_out_today')->default('1999-05-01 00:00:00');
            $table->integer('sisa_cuti')->default(12);
            $table->integer('hadir')->default(0);
            $table->integer('tidak_hadir')->default(0);
            $table->integer('cuti')->default(0);
            $table->string('status_duty')->nullable();
            $table->date('akhir_cuti')->nullable();
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
        Schema::dropIfExists('users');
    }
};
