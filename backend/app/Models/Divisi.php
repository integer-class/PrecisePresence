<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika nama tabel mengikuti konvensi)
    protected $table = 'divisi';
    //primary key
    protected $primaryKey = 'id_divisi';

    // Kolom yang dapat diisi
    protected $fillable = [

        'nama_divisi',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_divisi');
    }
}
