<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'id_karyawan ',
        'nama',
        'email',
        'alamat',
        'jenis_kelamin',
        'ttl',
        'no_hp',
        'id_users',
        'foto',
        'id_divisi',
        'id_cabang',
    ];

    public function devisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }

}
