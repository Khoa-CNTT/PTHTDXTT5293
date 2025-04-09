<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChuyenXe extends Model
{
    protected $table = 'chuyen_xes';
    protected $fillable = [
        'KhachHang_id',
        'TaiXe_id',
        'Ma_id',
        'DiaDiemDon',
        'DiaDiemDen',
        'LoaiXe',
        'GiaTien',
        'ThoiGian',
        'TrangThai',
    ];
}
