<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'Transaksi Peminjaman';

    protected $fillable = [
        'id_kendaraan',
        'id_user',
        'target_tanggal_waktu_kembali',
        'aktif',
    ];
}
