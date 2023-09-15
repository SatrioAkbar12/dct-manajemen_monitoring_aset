<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatistikPenggunaanAset extends Model
{
    use HasFactory;

    protected $table = 'statistik_penggunaan_aset';

    protected $fillable = [
        'id_aset',
        'id_user',
        'jumlah',
    ];

    public function aset(): BelongsTo
    {
        return $this->belongsTo(Aset::class, 'id_aset', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
