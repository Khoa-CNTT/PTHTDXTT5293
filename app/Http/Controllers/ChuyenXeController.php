<?php

namespace App\Http\Controllers;

use App\Models\ChuyenXe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChuyenXeController extends Controller
{
    public function getData()
    {
        $data = ChuyenXe::get();
        return response()->json([
            'data' => $data,
        ]);
    }

    // đặt xe
    public function store(Request $request)
    {
        // Lấy thông tin khách hàng từ guard 'khachhang'
        $Account_Login = Auth::guard('sanctum')->user();

        // Kiểm tra chưa đăng nhập
        if (!$Account_Login) {
            return response()->json([
                'status' => false,
                'message' => 'Khách hàng chưa đăng nhập hoặc session không hợp lệ.',
            ]);
        }

        // Tạo chuyến xe mới
        $chuyenXe = ChuyenXe::create([
            'KhachHang_id'       => $Account_Login->id,
            'TaiXe_id'           => $request->TaiXe_id,
            'TaiXe'                 => $request->TaiXe,
            'DiaDiemDon'         => $request->DiaDiemDon,
            'DiaDiemDen'         => $request->DiaDiemDen,
            'LoaiXe'             => $request->LoaiXe,
            'GiaTien'            => $request->GiaTien,
            'BienSo'            => $request->BienSo,
            'SoKm'            => $request->SoKm,
            'HinhThucThanhToan'  => $request->HinhThucThanhToan,
            'ThoiGian'           => now(),
            'TrangThai'          => 'Chờ xác nhận',
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Khách hàng đã đặt xe thành công!',
            'data'    => $chuyenXe,
        ]);
    }

    // nhận chuyến xe tài xế
    public function nhanChuyenXe(Request $request)
    {
        // Lấy thông tin tài xế đang đăng nhập
        $taiXe = Auth::guard('sanctum')->user();

        // Kiểm tra tài xế đã đăng nhập chưa
        if (!$taiXe) {
            return response()->json([
                'status' => false,
                'message' => 'Tài xế chưa đăng nhập hoặc token/session không hợp lệ.',
            ]);
        }

        // Tìm chuyến xe theo ID
        $chuyenXe = ChuyenXe::find($request->chuyen_xe_id);

        // Kiểm tra chuyến xe có tồn tại không
        if (!$chuyenXe) {
            return response()->json([
                'status' => false,
                'message' => 'Chuyến xe không tồn tại.',
            ]);
        }

        // Kiểm tra xem chuyến xe đã được nhận chưa
        if ($chuyenXe->TaiXe_id !== null) {
            return response()->json([
                'status' => false,
                'message' => 'Chuyến xe đã được tài xế khác nhận.',
            ]);
        }

        // Cập nhật thông tin tài xế nhận chuyến xe
        $chuyenXe->TaiXe_id = $taiXe->id;
        $chuyenXe->TrangThai = 'Đang thực hiện';
        $chuyenXe->save();

        return response()->json([
            'status' => true,
            'message' => 'Bạn đã nhận chuyến xe thành công!',
            'data' => $chuyenXe,
        ]);
    }


    // ------------------quản lý đơn hàng - admin---------------------------
    // lấy danh sách tất cả đơn
    public function getAllOrders()
    {
        $admin = Auth::guard('sanctum')->user();

        $data = ChuyenXe::get();
        return response()->json([
            'data' => $data
        ]);
    }

    // Cập nhật trạng thái đơn
    public function adminUpdateStatus(Request $request)
    {
        // Tìm chuyến xe theo ID
        $don = ChuyenXe::find($request->id);

        if (!$don) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy đơn hàng.',
            ]);
        }

        // Cập nhật trạng thái chuyến xe
        $don->TrangThai = $request->TrangThai;
        $don->save();

        return response()->json([
            'status' => true,
            'message' => 'Trạng thái đơn hàng đã được cập nhật.',
        ]);
    }

    // Xóa đơn
    public function adminDeleteOrder(Request $request)
    {
        $admin = Auth::guard('sanctum')->user();

        $don = ChuyenXe::find($request->id);

        if (!$don) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy đơn hàng.',
            ]);
        }

        // Xóa chuyến xe
        $don->delete();

        return response()->json([
            'status' => true,
            'message' => 'Đơn hàng đã được xóa.',
        ]);
    }


    //------------------quản lý đơn hàng - tài xế------------------------------
    // lấy danh sách đơn hàng của tài xế
    public function getDriverOrders()
    {
        $taixe = Auth::guard('sanctum')->user();

        if (!$taixe) {
            return response()->json([
                'status' => false,
                'message' => 'Tài xế chưa đăng nhập',
            ]);
        }

        $donHang = ChuyenXe::where('TaiXe_id', $taixe->id)
            ->where('TrangThai', '!=', 'Đã hủy')
            ->orderBy('ThoiGian', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $donHang,
        ]);
    }

    //cập nhật trạng thái đơn hàng
    public function updateStatus(Request $request)
    {

        $user = Auth::guard('sanctum')->user();

        $don = ChuyenXe::where('id', $request->id)
            ->where('TaiXe_id', $user->id)
            ->first();

        if (!$don) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy đơn hàng.'
            ]);
        }

        $don->TrangThai = $request->TrangThai;
        $don->save();

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật trạng thái thành công.'
        ]);
    }

    // xác nhận đơn đặt xe
    public function acceptOrder(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $don = ChuyenXe::where('id', $request->id)
            ->whereNull('TaiXe_id')
            ->where('TrangThai', 'Chờ xác nhận')
            ->first();

        if (!$don) {
            return response()->json([
                'status' => false,
                'message' => 'Không thể nhận đơn này.'
            ]);
        }

        $don->TaiXe_id = $user->id;
        $don->TrangThai = 'Đang hoạt động';
        $don->save();

        return response()->json([
            'status' => true,
            'message' => 'Đã nhận đơn thành công.'
        ]);
    }


    //------------quản lý đơn hàng - khách hàng----------------------------

    public function getDon()
    {
        $user = Auth::guard('sanctum')->user();

        $dsDon = ChuyenXe::where('KhachHang_id', $user->id)
            ->orderBy('ThoiGian', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $dsDon
        ]);
    }

    // xem chi tiết đơn
    public function show(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $don = ChuyenXe::where('id', $request->id)
            ->where('KhachHang_id', $user->id)
            ->first();

        if (!$don) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy đơn này.'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $don
        ]);
    }

    // hủy đơn  (nếu trạng thái là "Chờ xác nhận")
    public function deleteOrder(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $don = ChuyenXe::where('id', $request->id)
            ->where('KhachHang_id', $user->id)
            ->first();

        if (!$don || $don->TrangThai !== 'Chờ xác nhận') {
            return response()->json([
                'status' => false,
                'message' => 'Không thể hủy đơn này.'
            ]);
        }

        $don->delete();
        return response()->json([
            'status' => true,
            'message' => 'Hủy đơn thành công.'
        ]);
    }
    // Đánh giá tài xế (sau khi chuyến xe hoàn thành)
    public function danhGia(Request $request)
    {
        $user = Auth::user();

        $don = ChuyenXe::where('id', $request->id)
            ->where('KhachHang_id', $user->id)
            ->first();

        if (!$don || $don->TrangThai !== 'Hoàn thành') {
            return response()->json([
                'status' => false,
                'message' => 'Bạn chỉ có thể đánh giá sau khi hoàn thành chuyến xe.'
            ]);
        }

        $don->rating = $request->rating ?? null;
        $don->feedback = $request->feedback ?? null;
        $don->save();

        return response()->json([
            'status' => true,
            'message' => 'Cảm ơn bạn đã đánh giá tài xế.'
        ]);
    }

    // lích sử chuyến xe
    public function lichSuKhachHang(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn chưa đăng nhập!.',
            ]);
        }

        $dsChuyenXe = ChuyenXe::where('KhachHang_id', $user->id)
            ->orderBy('ThoiGian', 'desc')
            ->get();

        // Format lại dữ liệu để gửi về FE
        $data = $dsChuyenXe->map(function ($item) {
            return [
                'ThoiGian'           => $item->ThoiGian,
                'DiaDiemDon'         => $item->DiaDiemDon,
                'DiaDiemDen'         => $item->DiaDiemDen,
                'LoaiXe'             => $item->LoaiXe,
                'GiaTien'            => $item->GiaTien,
                'TrangThai'          => $item->TrangThai,
                'SoKm'               => $item->SoKm,
                'BienSo'             => $item->BienSo,
                'TaiXe'              => $item->TaiXe,
                'DanhGia'            => $item->DanhGia,
                'HinhThucThanhToan'  => $item->HinhThucThanhToan,
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
}
