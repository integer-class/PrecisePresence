<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAbsensi extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'jenis_absensi';
    //primary key
    protected $primaryKey = 'id_jenis_absensi';

    // Kolom yang dapat diisi
    protected $fillable = [

        'nama_jenis_absensi',
        'aturan_waktu',
    ];
}
