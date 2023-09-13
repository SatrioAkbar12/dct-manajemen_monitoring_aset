<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatistikPeminjamanKendaraanUser extends Model
{
    use HasFactory;

    protected $table = 'statistik_peminjaman_kendaraan_user';

    protected $fillable = [
        'id_user',
        'id_kendaraan',
        'jumlah',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan', 'id');
    }
}
