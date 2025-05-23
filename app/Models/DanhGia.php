<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    protected $table = 'danh_gias';
    protected $fillable = [
        'danhgia_id',
        'id_khach',
        'id_taixe',
        'so_sao',
        'binh_luan',
    ];
}
