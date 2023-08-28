<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class KepemilikanAset extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kepemilikan_aset';

    protected $fillable = [
        'nama',
        'prefix'
    ];

    public function aset(): HasMany {
        return $this->hasMany(Aset::class, 'id_kepemilikan_aset', 'id');
    }
}
