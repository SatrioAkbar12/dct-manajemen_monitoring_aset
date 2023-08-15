<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KondisiToolsTransaksiPeminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kondisi_tools_transaksi_peminjaman';

    protected $fillable = [
        'id_list_tools',
        'status_kondisi',
        'deskripsi',
    ];

    public function listTools(): BelongsTo {
        return $this->belongsTo(ListToolsTransaksiPeminjaman::class, 'id_list_tools', 'id');
    }
}
