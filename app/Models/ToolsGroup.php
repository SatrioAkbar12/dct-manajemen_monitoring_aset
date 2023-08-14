<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToolsGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tools_groups';

    protected $fillable = [
        'nama',
    ];
}
