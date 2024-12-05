<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'absensi';

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'id_karyawan',
        'id_jadwal_absensi',
        'lon',
        'lat',
        'foto',
        'catatan',
        'status_absensi',
        'waktu_absensi',
        'status_absensi',

    ];

    // Relasi ke model Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    // Relasi ke model JadwalAbsensi
    public function jadwalAbsensi()
    {
        return $this->belongsTo(JadwalAbsensi::class, 'id_jadwal_absensi');
    }
}
