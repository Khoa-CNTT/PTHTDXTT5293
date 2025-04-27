<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichSuNapRut extends Model
{
    protected $table = 'lich_su_nap_ruts';
    protected $fillable = [
        'user_id',
        'taixe_id',
        'user_type',
        'so_tien',
        'ngan_hang',
        'so_tai_khoan',
        'loai_giao_dich',
        'ngay_giao_dich',
        //'hinh_thuc',
        'trang_thai',
    ];
}
