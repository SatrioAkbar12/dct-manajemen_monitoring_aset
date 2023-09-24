<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tool extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tools';

    protected $fillable = [
        'id_aset',
        'nama',
        'merk',
        'model',
        'deskripsi',
        'status_saat_ini',
        'id_gudang',
        'id_tools_group'
    ];

    public function aset(): BelongsTo {
        return $this->belongsTo(Aset::class, 'id_aset', 'id')->withTrashed();
    }

    public function gudang(): BelongsTo {
        return $this->belongsTo(Gudang::class, 'id_gudang', 'id');
    }

    public function toolsGroup(): BelongsTo {
        return $this->belongsTo(ToolsGroup::class, 'id_tools_group', 'id');
    }
}
