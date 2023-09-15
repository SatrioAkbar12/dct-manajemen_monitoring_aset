<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nama',
        'email',
        'password',
        'memiliki_sim',
        'first_login',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transaksiPeminjamanKendaraan(): HasMany
    {
        return $this->hasMany(TransaksiPeminjamanKendaraan::class, 'id_user', 'id');
    }

    public function transaksiPeminjamanTools(): HasMany
    {
        return $this->hasMany(TransaksiPeminjamanTool::class, 'id_user', 'id');
    }

    public function statistikPenggunaanAset(): HasMany
    {
        return $this->hasMany(StatistikPenggunaanAset::class, 'id_user', 'id');
    }
}
