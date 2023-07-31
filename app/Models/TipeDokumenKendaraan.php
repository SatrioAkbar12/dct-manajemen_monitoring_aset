<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeDokumenKendaraan extends Model
{
    use HasFactory;

    protected $table = 'tipe_dokumen_kendaraan';

    protected $fillable = [
        'nama_dokumen'
    ];
}
