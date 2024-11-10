<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perizinan extends Model
{
    use HasFactory;

    protected $table = 'perizinan'; // Nama tabel
    protected $fillable = [
       'jenis_izin',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
        'status',
        'id_karyawan',
        'dokumen_pendukung'

    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
