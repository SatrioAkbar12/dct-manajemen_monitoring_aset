<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServisRutinKendaraan extends Model
{
    use HasFactory;

    protected $table = 'servis_rutin_kendaraan';

    protected $fillable = [
        'id_kendaraan',
        'penggantian_oli',
        'cek_aki',
        'cek_rem',
        'cek_kopling',
        'cek_ban',
        'cek_lampu',
        'cek_ac',
        'tanggal_servis'
    ];
}
