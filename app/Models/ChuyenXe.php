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
        'TaiXe',
        'DichVu',
        'HinhThucThanhToan',
        'DiaDiemDon',
        'DiaDiemDen',
        'LoaiXe',
        'GiaTien',
        'ThoiGian',
        'BienSo',
        'SoKm',
        'DanhGia',
        'TrangThai',
    ];
    public function taiXe()
    {
        return $this->belongsTo(TaiXe::class, 'TaiXe_id');
    }
}
