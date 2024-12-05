<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('alamat');
            $table->string('jenis_kelamin');
            $table->string('no_hp');
            $table->string('ttl');
            $table->string('foto');
            $table->timestamps();
            $table->foreignId('id_users')->references('id')->on('users');
            $table->foreignId('id_divisi')->nullable()->references('id_divisi')->on('divisi');
            $table->foreignId('id_cabang')->nullable()->references('id_cabang')->on('cabang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
