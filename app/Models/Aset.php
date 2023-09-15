<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aset extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'aset';

    protected $fillable = [
        'kode_aset',
        'tipe_aset',
        'id_kepemilikan_aset',
    ];

    public function kepemilikanAset(): BelongsTo {
        return $this->belongsTo(KepemilikanAset::class, 'id_kepemilikan_aset', 'id');
    }

    public function kendaraan(): HasOne {
        return $this->hasOne(Kendaraan::class, 'id_aset', 'id');
    }

    public function tool(): HasOne {
        return $this->hasOne(Tool::class, 'id_aset', 'id');
    }

    public function statistikPenggunaanAset(): HasMany {
        return $this->hasMany(StatistikPenggunaanAset::class, 'id_aset', 'id');
    }
}
