<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaGiamGia extends Model
{
    protected $table = 'ma_giam_gias';
    protected $fillable = [
        'code',
        'tinh_trang',
        'ngay_bat_dau',
        'ngay_het_han',
        'loai_giam_gia',
        'so_giam_gia',
        'so_tien_toi_da',
        'so_tien_toi_thieu',
    ];
}
