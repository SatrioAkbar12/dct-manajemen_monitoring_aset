<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramData extends Model
{
    use HasFactory;

    protected $table = 'telegram_data';

    protected $fillable = [
        'id_telegram',
        'username',
        'tipe'
    ];
}
