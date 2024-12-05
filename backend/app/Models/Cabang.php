<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'cabang';
    //primary key
    protected $primaryKey = 'id_cabang';

    // Kolom yang dapat diisi
    protected $fillable = [

        'latitude',
        'longitude',
        'foto_cabang',
        'radius',
        'nama_cabang',
        'alamat_cabang',
    ];
}
