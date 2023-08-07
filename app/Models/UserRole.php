<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    protected $fillable = [
        'id_user',
        'id_role'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }
}
