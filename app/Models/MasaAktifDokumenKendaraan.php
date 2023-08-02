<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasaAktifDokumenKendaraan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'masa_aktif_dokumen_kendaraan';

    protected $fillable = [
        'id_kendaraan',
        'id_tipe_dokumen',
        'tanggal_masa_berlaku'
    ];

    public function kendaraan(): BelongsTo {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id');
    }

    public function tipeDokumen(): BelongsTo {
        return $this->belongsTo(TipeDokumenKendaraan::class, 'id_tipe_dokumen', 'id');
    }
}
