<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServisRutinKendaraan extends Model
{
    use HasFactory, SoftDeletes;

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

    public function kendaraan(): BelongsTo {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id');
    }
}
