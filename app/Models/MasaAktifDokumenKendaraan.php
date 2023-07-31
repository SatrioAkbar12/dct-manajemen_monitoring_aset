<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasaAktifDokumenKendaraan extends Model
{
    use HasFactory;

    protected $table = 'masa_aktif_dokumen_kendaraan';

    protected $fillable = [
        'id_kendaraan',
        'id_tipe_dokumen',
        'tanggal_masa_berlaku'
    ];
}
