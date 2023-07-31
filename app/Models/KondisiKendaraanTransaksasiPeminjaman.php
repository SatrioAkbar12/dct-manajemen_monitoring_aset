<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiKendaraanTransaksasiPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'kondisi_kendaraan_transaksi_peminjaman';

    protected $fillable = [
        'id_transaksi',
        'status_kondisi',
        'deskripsi',
        'foto'
    ];
}
