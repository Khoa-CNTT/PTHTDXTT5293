<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichSuNapRut extends Model
{
    protected $table = 'lich_su_nap_ruts';
    protected $fillable = [
        'user_id',
        'user_type',
        'so_tien',
        'loai_giao_dich',
        'ngay_giao_dich',
        'hinh_thuc',
        'trang_thai',
    ];
}
