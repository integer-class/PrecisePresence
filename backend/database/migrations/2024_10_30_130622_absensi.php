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
            $table->foreignId('id_karyawan')->references('id_karyawan')->on('karyawan');
            $table->string('lon');
            $table->string('lat');
            $table->string('foto_checkin')->nullable();
            $table->string('foto_checkout')->nullable();
            $table->timestamp('check_in_time')->nullable();
            $table->timestamp('check_out_time')->nullable();
            $table->enum('status', ['checkin', 'checkout'])->default('checkin');
            $table->timestamp('lembur_start_time')->nullable();
            $table->timestamp('lembur_end_time')->nullable();
            $table->integer('durasi_lembur')->nullable();
            $table->text('keterangan')->nullable();
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
