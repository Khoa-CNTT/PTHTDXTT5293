<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhanQuyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietPhanQuyenController extends Controller
{
    public function capQuyen(Request $request)
    {

        $chuc_nang_id = 35;
        $Account_Login = Auth::guard('sanctum')->user();
        $quyen_id = $$Account_Login->$chuc_nang_id;
        $check_quyen = ChiTietPhanQuyen::where('quyen_id', $quyen_id)
            ->where('chuc_nang_id', $chuc_nang_id)
            ->first();
        if ($check_quyen) {
            return response()->json([
                'data' => false,
                'message' => "bạn không có quyền thực hiện chức năng này!"
            ]);
        }

        $quyen = ChiTietPhanQuyen::where('quyen_id', $request->quyen_id)
            ->where('chuc_nang_id', $request->chuc_nang_id)
            ->first();

        if ($quyen) {
            return response()->json([
                'status'  => false,
                'message' => 'Quyền đã tồn tại!',
            ]);
        }

        ChiTietPhanQuyen::create([
            'quyen_id'      => $request->quyen_id,
            'chuc_nang_id'  => $request->chuc_nang_id,
        ]);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã phân quyền thành công!'
        ]);
    }

    public function getData(Request $request)
    {

        $chuc_nang_id = 36;
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

        $data   = ChiTietPhanQuyen::join('chuc_nangs', 'chi_tiet_phan_quyens.chuc_nang_id', 'chuc_nangs.id')
            ->join('phan_quyens', 'chi_tiet_phan_quyens.quyen_id', 'phan_quyens.id')
            ->where('chi_tiet_phan_quyens.quyen_id', $request->quyen_id)
            ->select('chi_tiet_phan_quyens.*', 'chuc_nangs.ten_chuc_nang', 'phan_quyens.ten_quyen')
            ->get();

        return response()->json([
            'data'    =>  $data,
        ]);
    }
    public function xoaQuyen(Request $request)
    {

        $chuc_nang_id = 37;
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
        ChiTietPhanQuyen::where('id', $request->id)->delete();

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã xoá phân quyền thành công!'
        ]);
    }
}
