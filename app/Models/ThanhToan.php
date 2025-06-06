<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThanhToan extends Model
{
    protected $table = 'thanh_toans';
    protected $fillable = [
        'so_tien_thanh_toan',
        'phuong_thuc_thanh_toan',
        'trang_thai',
        'ma_giam_gia',
        'thoi_gian_thanh_toan',
        'ma_giao_dich',
    ];
}
