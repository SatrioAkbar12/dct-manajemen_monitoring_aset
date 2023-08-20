<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListToolsTransaksiPeminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'list_tools_transaksi_peminjaman';

    protected $fillable = [
        'id_peminjaman_tool',
        'id_aset',
    ];

    public function transaksiPeminjamanTool(): BelongsTo {
        return $this->belongsTo(TransaksiPeminjamanTool::class, 'id_peminjaman_tool', 'id');
    }

    public function aset(): BelongsTo {
        return $this->belongsTo(Aset::class, 'id_aset', 'id');
    }

    public function kondisiToolsTransaksiPeminjaman(): HasOne {
        return $this->hasOne(KondisiToolsTransaksiPeminjaman::class, 'id_list_tools', 'id');
    }
}
