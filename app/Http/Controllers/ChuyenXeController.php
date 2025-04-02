<?php

namespace App\Http\Controllers;

use App\Models\ChuyenXe;
use Illuminate\Http\Request;

class ChuyenXeController extends Controller
{
    public function store(Request $request){
        ChuyenXe::create([
            'dia_diem_don'  =>$request->dia_diem_don,
            'dia_diem_den'  =>$request->dia_diem_den,
            'loai_xe'       =>$request->loai_xe,
            'gia_tien'      =>$request->gia_tien,
            'trang_thai'    =>$request->trang_thai,
        ]);
        return response()->json([
            'status'  => 1,
            'message' => 'Đã thêm mới chuyến xe thành công.'
        ]);
    }
    public function getdate()
    {
        
    }
}
