<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\KhachHang;
use App\Models\TaiXe;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function getData(Request $request)
    {
        try {
            $tuNgay = $request->tu_ngay ? Carbon::parse($request->tu_ngay)->startOfDay() : Carbon::now()->startOfMonth();
            $denNgay = $request->den_ngay ? Carbon::parse($request->den_ngay)->endOfDay() : Carbon::now()->endOfMonth();

            // Tổng doanh thu trong khoảng thời gian
            $tongDoanhThu = DonHang::whereBetween('created_at', [$tuNgay, $denNgay])
                                ->where('trang_thai', 'Thành công')
                                ->sum('tong_tien');

            // Số đơn hàng thành công
            $soDonHang = DonHang::whereBetween('created_at', [$tuNgay, $denNgay])
                                ->where('trang_thai', 'Thành công')
                                ->count();

            // Số khách hàng mới trong tháng này
            $khachHangMoi = KhachHang::whereMonth('created_at', Carbon::now()->month)
                                    ->whereYear('created_at', Carbon::now()->year)
                                    ->count();

            // Số tài xế mới trong tháng này
            $taiXeMoi = TaiXe::whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->count();

            // Doanh thu theo tháng
            $doanhThuTheoThang = DonHang::where('trang_thai', 'Thành công')
                ->whereBetween('created_at', [$tuNgay, $denNgay])
                ->select(
                    DB::raw('MONTH(created_at) as thang'),
                    DB::raw('SUM(tong_tien) as doanh_thu')
                )
                ->groupBy('thang')
                ->orderBy('thang')
                ->get();

            // Thống kê trạng thái đơn hàng
            $donHangThanhCong = DonHang::whereBetween('created_at', [$tuNgay, $denNgay])
                                    ->where('trang_thai', 'Thành công')
                                    ->count();
            $donHangDangXuLy = DonHang::whereBetween('created_at', [$tuNgay, $denNgay])
                                    ->where('trang_thai', 'Đang xử lý')
                                    ->count();
            $donHangThatBai = DonHang::whereBetween('created_at', [$tuNgay, $denNgay])
                                    ->where('trang_thai', 'Thất bại')
                                    ->count();

            // Top khách hàng
            $topKhachHang = DonHang::join('khach_hang', 'don_hang.khach_hang_id', '=', 'khach_hang.id')
                ->whereBetween('don_hang.created_at', [$tuNgay, $denNgay])
                ->where('don_hang.trang_thai', 'Thành công')
                ->select(
                    'khach_hang.id',
                    'khach_hang.ho_ten',
                    DB::raw('COUNT(*) as so_don_hang'),
                    DB::raw('SUM(tong_tien) as tong_chi_tieu')
                )
                ->groupBy('khach_hang.id', 'khach_hang.ho_ten')
                ->orderBy('tong_chi_tieu', 'desc')
                ->limit(5)
                ->get();

            // Top tài xế
            $topTaiXe = DonHang::join('tai_xe', 'don_hang.tai_xe_id', '=', 'tai_xe.id')
                ->whereBetween('don_hang.created_at', [$tuNgay, $denNgay])
                ->where('don_hang.trang_thai', 'Thành công')
                ->select(
                    'tai_xe.id',
                    'tai_xe.ho_ten',
                    DB::raw('COUNT(*) as so_chuyen_xe'),
                    DB::raw('AVG(danh_gia) as danh_gia')
                )
                ->groupBy('tai_xe.id', 'tai_xe.ho_ten')
                ->orderBy('so_chuyen_xe', 'desc')
                ->limit(5)
                ->get();

            return response()->json([
                'status' => true,
                'data' => [
                    'tong_doanh_thu' => $tongDoanhThu,
                    'so_don_hang' => $soDonHang,
                    'khach_hang_moi' => $khachHangMoi,
                    'tai_xe_moi' => $taiXeMoi,
                    'tu_ngay' => $tuNgay,
                    'den_ngay' => $denNgay,
                    'doanh_thu_theo_thang' => $doanhThuTheoThang,
                    'don_hang_thanh_cong' => $donHangThanhCong,
                    'don_hang_dang_xu_ly' => $donHangDangXuLy,
                    'don_hang_that_bai' => $donHangThatBai,
                    'top_khach_hang' => $topKhachHang,
                    'top_tai_xe' => $topTaiXe,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
