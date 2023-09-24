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
        'km_terakhir',
        'jumlah_km',
        'foto_speedometer_sebelum',
        'foto_speedometer_sesudah',
        'foto_depan_kembali',
        'foto_belakang_kembali',
        'foto_kanan_kembali',
        'foto_kiri_kembali',
        'foto_depan_pinjam',
        'foto_belakang_pinjam',
        'foto_kanan_pinjam',
        'foto_kiri_pinjam',
    ];

    public function transaksiPeminjamanKendaraan(): BelongsTo {
        return $this->belongsTo(TransaksiPeminjamanKendaraan::class, 'id_transaksi', 'id');
    }
}
