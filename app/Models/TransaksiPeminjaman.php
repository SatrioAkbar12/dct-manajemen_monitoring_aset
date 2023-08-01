<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiPeminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Transaksi Peminjaman';

    protected $fillable = [
        'id_kendaraan',
        'id_user',
        'target_tanggal_waktu_kembali',
        'aktif',
    ];
}
