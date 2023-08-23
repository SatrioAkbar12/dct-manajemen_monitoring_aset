<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiPeminjamanTool extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi_peminjaman_tool';

    protected $fillable = [
        'tanggal_waktu_pinjam',
        'target_tanggal_waktu_kembali',
        'id_user',
        'aktif',
        'tanggal_waktu_kembali',
        'id_gudang_kembali',
        'keperluan',
        'lokasi_tujuan',
        'approved',
        'keterangan_approved',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function gudang(): BelongsTo {
        return $this->belongsTo(Gudang::class, 'id_gudang_kembali', 'id');
    }

    public function listTools(): HasMany {
        return $this->hasMany(ListToolsTransaksiPeminjaman::class, 'id_peminjaman_tool', 'id');
    }
}
