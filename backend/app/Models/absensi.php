<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'id_karyawan',
        'lon',
        'lat',
        'foto_check_in',
        'foto_check_out',
        'check_in_time',
        'check_out_time',
        'status',
        'durasi_lembur'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
