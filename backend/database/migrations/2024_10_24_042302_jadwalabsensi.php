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
        Schema::create('jadwal_absensi', function (Blueprint $table) {
            $table->id('id_jadwal_absensi');
            $table->foreignId('id_divisi')->constrained('divisi', 'id_divisi')->onDelete('cascade');
            $table->enum('jenis_absensi', ['masuk', 'istirahat', 'isoma', 'pulang']);
            $table->foreignId('id_jenis_absensi')->constrained('jenis_absensi', 'id_jenis_absensi')->onDelete('cascade');

            $table->time('waktu');
            $table->timestamps();
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
