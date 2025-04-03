<?php

namespace App\Http\Controllers;

use App\Models\MaGiamGia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MaGiamGiaController extends Controller
{
    // data
    public function getData()
    {
        $data = MaGiamGia::get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function getDataOpen() {}

    // Kiểm tra mã giảm giá
    public function checkCode(Request $request)
    {
        $MaGiamGia = MaGiamGia::where('code', $request->code)
            ->whereData('ngay_bat_dau', "<=", Carbon::today())
            ->whereData('ngay_ket_thuc', ">=", Carbon::today())
            ->where('tinh_trang', 1)
            ->first();

        if ($MaGiamGia) {
            return response()->json([
                'status' => true,
                'coupon' => $MaGiamGia,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Mã giảm giá không tồn tại trong hệ thống.",
            ]);
        }
    }

    // thêm mã giảm giá
    public function createCode(Request $request)
    {
        MaGiamGia::create($request->all());
        return response()->json([
            'status' => true,
            'message' => "Đã tạo mới mã giảm giá " . $request->code . " thành công.",
        ]);
    }

    // xóa mã giảm giá
    public function deleteCode(Request $request)
    {
        MaGiamGia::where('id', $request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => "Đã xóa mã giảm giá" . $request->ma_code . " thành công.",
        ]);
    }

    // cập nhật mã giảm giá
    public function updateCode(Request $request)
    {
        MaGiamGia::where('id', $request->id)->update([
            'code'                  => $request->code,
            'tinh_trang'            => $request->tinh_trang,
            'ngay_bat_dau'          => $request->ngay_bat_dau,
            'ngay_het_han'         => $request->ngay_het_han,
            'loai_giam_gia'         => $request->loai_giam_gia,
            'so_giam_gia'           => $request->so_giam_gia,
            'so_tien_toi_da'        => $request->so_tien_toi_da,
            'so_tien_toi_thieu'    => $request->so_tien_toi_thieu,
        ]);
        return response()->json([
            'status' => true,
            'message' => "Đã update mã giảm giá" . $request->ma_code . " thành công.",
        ]);
    }

    // đổi trạng thái mã giảm giá
    public function changeCode(Request $request)
    {
        $MaGiamGia = MaGiamGia::where('id', $request->id)->first();

        if ($MaGiamGia) {
            if ($MaGiamGia->tinh_trang == 0) {
                $MaGiamGia->tinh_trang == 1;
            } else {
                $MaGiamGia->tinh_trang == 0;
            }
            $MaGiamGia->save();

            return response()->json([
                'status'    => true,
                'message'   => "Đã cập nhật trạng thái mã giảm giá thành công!"
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Mã giảm giá không tồn tại!"
            ]);
        }
    }
}
