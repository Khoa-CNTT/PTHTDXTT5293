<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    protected $table = 'danh_gias';
    protected $fillable = [
        'so_sao',
        'binh_luạn',
    ];
}
