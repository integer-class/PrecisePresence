<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {


        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_karyawan')->constrained('karyawan', 'id_karyawan')->onDelete('cascade');
            $table->foreignId('id_jadwal_absensi')->constrained('jadwal_absensi', 'id_jadwal_absensi')->onDelete('cascade');
            $table->string('lon');
            $table->string('lat');
            $table->string('foto')->nullable();
            $table->timestamp('waktu_absensi');
            $table->enum('status_absen', ['hadir', 'tidak_hadir'])->default('hadir');
            $table->string('status_absensi');
            $table->text('catatan')->nullable();
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
