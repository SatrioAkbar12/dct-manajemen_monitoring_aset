<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatistikPeminjamanToolsUser extends Model
{
    use HasFactory;

    protected $table = 'statistik_peminjaman_tools_user';

    protected $fillable = [
        'id_user',
        'id_tools',
        'jumlah'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function tools(): BelongsTo
    {
        return $this->belongsTo(Tool::class, 'id_tools', 'id');
    }
}
