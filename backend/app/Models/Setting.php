<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'settings';

    // Kolom yang dapat diisi
    protected $fillable = [
        'latitude',
        'longitude',
        'radius',
        'jam_masuk',
        'jam_keluar'
    ];
}
