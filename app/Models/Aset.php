<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aset extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'aset';

    protected $fillable = [
        'kode_aset',
    ];

    public function kendaraan(): HasOne {
        return $this->hasOne(Kendaraan::class, 'id_aset', 'id');
    }
}
