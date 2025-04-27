<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhanQuyen;
use App\Models\PhanQuyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhanQuyenController extends Controller
{
    public function getData()
    {
        $chuc_nang_id = 1;
        $Account_Login = Auth::guard('sanctum')->user();
        $quyen_id = $Account_Login->$chuc_nang_id;
        $check_quyen = ChiTietPhanQuyen::where('quyen_id', $quyen_id)
            ->where('chuc_nang_id', $chuc_nang_id)
            ->first();
        if ($check_quyen) {
            return response()->json([
                'data' => false,
                'message' => "bạn không có quyền thực hiện chức năng này!"
            ]);
        }
        $data = PhanQuyen::get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function createData(Request $request)
    {
        $chuc_nang_id = 2;
        $Account_Login = Auth::guard('sanctum')->user();
        $quyen_id = $Account_Login->$chuc_nang_id;
        $check_quyen = ChiTietPhanQuyen::where('quyen_id', $quyen_id)
            ->where('chuc_nang_id', $chuc_nang_id)
            ->first();
        if ($check_quyen) {
            return response()->json([
                'data' => false,
                'message' => "bạn không có quyền thực hiện chức năng này!"
            ]);
        }
        PhanQuyen::create([
            'ten_quyen'         => $request->ten_quyen,
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Thêm mới tên quyền thành công!'
        ]);
    }

    public function UpateData(Request $request)
    {
        $chuc_nang_id = 3;
        $Account_Login = Auth::guard('sanctum')->user();
        $quyen_id = $Account_Login->$chuc_nang_id;
        $check_quyen = ChiTietPhanQuyen::where('quyen_id', $quyen_id)
            ->where('chuc_nang_id', $chuc_nang_id)
            ->first();
        if ($check_quyen) {
            return response()->json([
                'data' => false,
                'message' => "bạn không có quyền thực hiện chức năng này!"
            ]);
        }
        $ten_quyen = PhanQuyen::where('id', $request->id)->first();
        if ($ten_quyen) {
            $ten_quyen->update([
                'ten_quyen'             => $request->ten_quyen,

            ]);

            return response()->json([
                'status' => true,
                'message' => "Cập Nhật tên quyền thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có Lỗi"
            ]);
        }
    }

    public function deleteData($id)
    {
        $chuc_nang_id = 41;
        $Account_Login = Auth::guard('sanctum')->user();
        $quyen_id = $Account_Login->$chuc_nang_id;
        $check_quyen = ChiTietPhanQuyen::where('quyen_id', $quyen_id)
            ->where('chuc_nang_id', $chuc_nang_id)
            ->first();
        if ($check_quyen) {
            return response()->json([
                'data' => false,
                'message' => "bạn không có quyền thực hiện chức năng này!"
            ]);
        }
        $ten_quyen = PhanQuyen::where('id', $id)->first();

        if ($ten_quyen) {
            $ten_quyen->delete();

            return response()->json([
                'status' => true,
                'message' => "Đã xóa tên quyền thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có Lỗi"
            ]);
        }
    }

    public function search(Request $request)
    {
        $noi_dung_tim = '%' . $request->noi_dung_tim . '%';
        $data   =  PhanQuyen::where('ten_quyen', 'like', $noi_dung_tim)
            ->get();
        return response()->json([
            'data'  => $data
        ]);
    }
}
