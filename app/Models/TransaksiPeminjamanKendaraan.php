<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiPeminjamanKendaraan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi_peminjaman_kendaraan';

    protected $fillable = [
        'id_kendaraan',
        'id_user',
        'target_tanggal_waktu_kembali',
        'aktif',
        'tanggal_waktu_pinjam',
        'tanggal_waktu_kembali',
    ];

    public function kendaraan(): BelongsTo {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kondisiKendaraan(): HasOne {
        return $this->hasOne(KondisiKendaraanTransaksasiPeminjaman::class, 'id_transaksi', 'id');
    }
}
