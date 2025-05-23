<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    public function getData()
    {
        $data = DanhGia::get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function create(Request $request)
    {
        $DanhGia = DanhGia::create([
            'so_sao'        => $request->so_sao,
            'binh_luan'     => $request->binh_luan,
        ]);
        return response()->json([
            'status' => true,
            'message' => "bạn đã đánh giá thành công!"
        ]);
    }

    public function delete(Request $request)
    {
        $DanhGia = DanhGia::find($request->id);
        if (!$DanhGia) {
            return response()->json([
                'status'  => false,
                'message' => "Đánh giá không tồn tại."
            ]);
        }
        $DanhGia->delete();
        return response()->json([
            'status' => true,
            'message' => "Đánh giá đã được xóa thành công!"
        ]);
    }
    public function update(Request $request)
    {
        $DanhGia = DanhGia::find($request->id);
        if (!$DanhGia) {
            return response()->json([
                'status'  => false,
                'message' => "Đánh giá không tồn tại."
            ]);
        }
        $DanhGia->update([
            'so_sao'    => $request->so_sao,
            'binh_luan' => $request->binh_luan,
        ]);
        return response()->json([
            'status' => true,
            'message' => "Đã cập nhật đánh giá thành công.",
        ]);
    }
}
