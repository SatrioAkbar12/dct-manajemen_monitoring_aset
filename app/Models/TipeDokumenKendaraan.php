<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipeDokumenKendaraan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tipe_dokumen_kendaraan';

    protected $fillable = [
        'nama_dokumen'
    ];
}
