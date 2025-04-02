<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichSuNapRut extends Model
{
    protected $table = 'lich_su_nap_ruts';
    protected $fillable = [
        'so_tien',
        'loai_giao_dich',
        'trang_thai',
    ];
}
