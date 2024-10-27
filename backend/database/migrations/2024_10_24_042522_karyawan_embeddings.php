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
        Schema::create('karyawan_embeddings', function (Blueprint $table) {
            $table->id('id_embedding');
            // Change the foreign key reference to match the actual column in the karyawan table
            $table->foreignId('id_karyawan')->constrained('karyawan', 'id_karyawan')->onDelete('cascade');
            $table->json('embedding');  // Embedding disimpan dalam format JSON
            $table->string('image_name', 255)->nullable();  // Nama gambar atau informasi terkait gambar
            $table->timestamps();  // Menyediakan created_at dan updated_at otomatis
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
