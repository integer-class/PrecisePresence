<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';


    protected $fillable = ['id_karyawan', 'waktu'];
}
