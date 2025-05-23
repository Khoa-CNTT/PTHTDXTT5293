<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViTien extends Model
{
    protected $table = 'vi_tiens';
    protected $fillable = [
        'user_id',
        'taixe_id',
        'so_du',
    ];
}
