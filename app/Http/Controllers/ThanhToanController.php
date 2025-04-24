<?php

namespace App\Http\Controllers;

use App\Models\ThanhToan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThanhToanController extends Controller
{
    public function Pay(Request $request)
    {
        $thanhToan = ThanhToan::create([
            'chuyen_xe_id' => $request->chuyen_xe_id,
            'so_tien_thanh_toan' => $request->so_tien_thanh_toan,
            'phuong_thuc_thanh_toan' => $request->phuong_thuc_thanh_toan,
            'trang_thai' => 1, // 1 = Đã thanh toán
            'ma_giam_gia' => $request->ma_giam_gia,
            'ma_giao_dich' => $request->ma_giao_dich,
            'thoi_gian_thanh_toan' => Carbon::now(),
        ]);

        // (Tuỳ chọn) Cập nhật trạng thái chuyến xe nếu cần
        \App\Models\ChuyenXe::where('id', $request->chuyen_xe_id)->update([
            'TrangThai' => 'Đã thanh toán',
        ]);
        return response()->json([
            'status' => true,
            'message' => "Bạn đã thanh toán chuyến xe thành công!."
        ]);
    }
}
