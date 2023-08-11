<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kendaraan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kendaraan';

    protected $fillable = [
        'nopol',
        'merk',
        'warna',
        'id_jenis_kendaraan',
        'tipe',
        'km_saat_ini',
    ];

    public function jenisKendaraan(): BelongsTo {
        return $this->belongsTo(JenisKendaraan::class, 'id_jenis_kendaraan', 'id');
    }

    public function masaAktifDokumen(): HasMany {
        return $this->hasMany(MasaAktifDokumenKendaraan::class, 'id_kendaraan', 'id');
    }

    public function servisRutin(): HasMany {
        return $this->hasMany(ServisRutinKendaraan::class, 'id_kendaraan', 'id')->orderBy('tanggal_servis', 'desc');
    }

    public function transaksiPeminjaman(): HasMany {
        return $this->hasMany(TransaksiPeminjaman::class, 'id_kendaraan', 'id');
    }
}
