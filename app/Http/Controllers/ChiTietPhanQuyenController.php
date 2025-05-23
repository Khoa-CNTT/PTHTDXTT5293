<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhanQuyen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietPhanQuyenController extends Controller
{
    public function capNhieuQuyen(Request $request)
    {

        $chuc_nang_id = 35;
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

        $idChucVu = $request->id_quyen;
        $danhSachQuyenMoi = $request->list_id_chuc_nang;

        // Lấy danh sách quyền cũ
        $quyenCu = ChiTietPhanQuyen::where('quyen_id', $idChucVu)->pluck('chuc_nang_id')->toArray();

        // Xác định quyền cần xóa (có trong cũ nhưng không có trong mới)
        $quyenCanXoa = array_diff($quyenCu, $danhSachQuyenMoi);
        if (!empty($quyenCanXoa)) {
            ChiTietPhanQuyen::where('quyen_id', $idChucVu)
                ->whereIn('chuc_nang_id', $quyenCanXoa)
                ->delete();
        }

        // Xác định quyền cần thêm (có trong mới nhưng không có trong cũ)
        $quyenCanThem = array_diff($danhSachQuyenMoi, $quyenCu);
        $data = [];
        foreach ($quyenCanThem as $idChucNang) {
            $data[] = ChiTietPhanQuyen::create([
                'quyen_id'  => $idChucVu,
                'chuc_nang_id'  => $idChucNang,
            ]);
        }

        return response()->json([
            'status'    => true,
            'message'   => 'Cập nhật phân quyền thành công!',
            'data'      => $data
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
            ->where('chi_tiet_phan_quyens.quyen_id', $request->id_quyen)
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
