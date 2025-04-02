<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChuyenXe extends Model
{
    protected $table = 'chuyen_xes';
    protected $fillable = [
        'dia_diem_don',
        'dia_diem_den',
        'loai_xe',
        'gia_tien',
        'trang_thai',
    ];
}
