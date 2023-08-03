<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KondisiKendaraanTransaksasiPeminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kondisi_kendaraan_transaksi_peminjaman';

    protected $fillable = [
        'id_transaksi',
        'status_kondisi',
        'deskripsi',
        'foto'
    ];

    public function transaksiPeminjaman(): BelongsTo {
        return $this->belongsTo(TransaksiPeminjaman::class, 'id_transaksi', 'id');
    }
}
