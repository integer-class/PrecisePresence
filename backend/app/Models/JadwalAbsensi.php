<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAbsensi extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'jadwal_absensi';

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'id_divisi',
        'id_jenis_absensi',
        'waktu',
    ];

    // Relasi ke model JenisAbsensi
    public function jenisAbsensi()
    {
        return $this->belongsTo(JenisAbsensi::class, 'id_jenis_absensi', 'id_jenis_absensi');
    }

    // Relasi ke model Absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_jadwal_absensi');
    }

    // Relasi ke model Divisi
    public function jadwal()
    {
        return $this->hasMany(JadwalAbsensi::class, 'id_divisi');
    }
}
