<?php

namespace App\Http\Controllers;

use App\Models\LichSuNapRut;
use App\Models\ViTien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LichSuNapTienController extends Controller
{
    public function getHistory(Request $request)
    {
        // Lấy người dùng từ guard 'khachhang'
        $user = Auth::guard('khachhang')->user();

        // Lấy người dùng từ guard 'taixe'
        $taiXe = Auth::guard('taixe')->user();

        // Kiểm tra nếu người dùng không đăng nhập cả hai guard
        if (!$user && !$taiXe) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn cần đăng nhập để xem lịch sử nạp rút tiền',
            ]);
        }

        // Xác định người dùng là khách hàng hay tài xế
        if ($user) {
            // Người dùng là khách hàng
            $userId = $user->id;
            $userType = 'khach_hang'; // Giả sử user_type của khách hàng là 'khach_hang'
        } else {
            // Người dùng là tài xế
            $userId = $taiXe->id;
            $userType = 'tai_xe'; // Giả sử user_type của tài xế là 'tai_xe'
        }

        // Lấy lịch sử nạp rút tiền của người dùng
        $lichSuNaps = LichSuNapRut::where('user_id', $userId)
            ->where('user_type', $userType)
            ->orderBy('ngay_nap', 'desc') // Sắp xếp theo ngày giao dịch mới nhất
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Lịch sử nạp rút tiền',
            'data' => $lichSuNaps
        ]);
    }

    // thêm lịch sử nạp rút tiền
    public function createNapRutKhachHang(Request $request)
    {
        $Account_Login = Auth::guard('sanctum')->user();

        if (!$Account_Login) {
            return response()->json([
                'status' => false,
                'message' => 'Khách hàng chưa đăng nhập.',
            ]);
        }

        $giaoDich = LichSuNapRut::create([
            'user_id' => $Account_Login->id,
            'user_type' => 'khach_hang',
            'so_tien' => $request->so_tien,
            'loai_giao_dich' => $request->loai_giao_dich,
            'hinh_thuc' => $request->hinh_thuc,
            'trang_thai' => $request->trang_thai,
            'ngay_giao_dich' => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Nạp/rút thành công (khách hàng)',
            'data' => $giaoDich
        ]);
    }

    // thêm lịch sử nạp rút tiền ( chưa test)
    public function createNapRutTaiXe(Request $request)
    {
        $user = Auth::guard('taixe')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Tài xế chưa đăng nhập.',
            ]);
        }

        $giaoDich = LichSuNapRut::create([
            'user_id' => $user->id,
            'user_type' => 'tai_xe',
            'so_tien' => $request->so_tien,
            'ngay_nap' => now(),
            'hinh_thuc' => $request->hinh_thuc,
            'loai_giao_dich' => $request->loai_giao_dich,
            'trang_thai' => $request->trang_thai,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Nạp/rút thành công (tài xế)',
            'data' => $giaoDich
        ]);
    }

    // xóa lịch sử giao dịch
    public function deleteGiaoDich(Request $request)
    {
        $lichSuNap = LichSuNapRut::find($request->id);

        if (!$lichSuNap) {
            return response()->json([
                'status' => false,
                'message' => 'Lịch sử giao dịch không tồn tại!'
            ]);
        }

        $lichSuNap->delete();

        return response()->json([
            'status' => true,
            'message' => 'Lịch sử giao dịch đã được xóa thành công!'
        ]);
    }

    // cập nhật trạng thái giao dịch
    public function updateStatus(Request $request)
    {
        $lichSuNap = LichSuNapRut::find($request->id);

        if (!$lichSuNap) {
            return response()->json([
                'status' => false,
                'message' => 'Lịch sử giao dịch không tồn tại!'
            ]);
        }

        $lichSuNap->update([
            'trang_thai' => $request->trang_thai
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật trạng thái giao dịch thành công!',
            'data' => $lichSuNap
        ]);
    }


    //////------------------ ví tiền khách hàng -----------------------
    // Lấy lịch sử nạp tiền của khách hàng
    public function index()
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn chưa đăng nhập.',
            ]);
        }

        $lichSu = LichSuNapRut::where('user_id', $user->id)
            ->whereIn('loai_giao_dich', ['nap_tien', 'rut_tien'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Lấy lịch sử giao dịch thành công.',
            'data' => $lichSu
        ]);
    }

    // Ghi nhận 1 lần nạp tiền mới
    public function store(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $so_tien = $request->so_tien;

        // Kiểm tra xem số tiền có hợp lệ không
        if (!$so_tien || $so_tien <= 5000) {
            return response()->json([
                'status' => false,
                'message' => 'Số tiền nạp không hợp lệ'
            ]);
        }

        // Tạo mã giao dịch ngẫu nhiên
        $ma_giao_dich = 'NAP' . strtoupper(uniqid()) . bin2hex(random_bytes(5));

        // Giả lập tạo mã QR bằng dịch vụ miễn phí (thay sau này bằng của ngân hàng thật)
        $link_thanhtoan = 'https://example.com/thanh-toan?ma=' . $ma_giao_dich . '&so_tien=' . $so_tien;
        $qr_url = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($link_thanhtoan);

        $lich_su_nap = LichSuNapRut::create([
            'user_id' => $user->id,
            'user_type' => $request->user_type,
            'so_tien' => $so_tien,
            'loai_giao_dich' => $request->loai_giao_dich,
            'ngay_giao_dich' => now(),
            'hinh_thuc' => $request->hinh_thuc,
            'trang_thai' => $request->trang_thai,
        ]);


        $vi_tien = ViTien::where('user_id', $user->id)->first();
        if ($vi_tien) {
            $vi_tien->so_du += $so_tien;
            $vi_tien->save();
        } else {

            ViTien::create([
                'user_id' => $user->id,
                'so_du' => $so_tien,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Tạo mã QR thành công',
            'qr_url' => $qr_url,
            'ma_giao_dich' => $ma_giao_dich,
            'lich_su_nap' => $lich_su_nap,
            'so_du' => $vi_tien ? $vi_tien->so_du : $so_tien
        ]);
    }

    // rút tiền
    public function drawMoney(Request $request)
    {

        // Lấy người dùng hiện tại
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn chưa đăng nhập!'
            ]);
        }

        // Kiểm tra mật khẩu
        if (!Hash::check($request->mat_khau, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Mật khẩu không đúng!'
            ]);
        }

        // Tìm ví tiền của người dùng
        $vi_tien = ViTien::where('user_id', $user->id)->first();

        if (!$vi_tien || $vi_tien->so_du < $request->so_tien) {
            return response()->json([
                'status' => false,
                'message' => 'Số dư không đủ để rút tiền!'
            ]);
        }

        // Trừ tiền và lưu lại
        $vi_tien->so_du -= $request->so_tien;
        $vi_tien->save();

        // Lưu lịch sử giao dịch rút tiền
        LichSuNapRut::create([
            'user_id' => $user->id,
            'so_tien' => $request->so_tien,
            'loai_giao_dich' => $request->loai_giao_dich, // Ghi nhận là giao dịch rút tiền
            'ngay_giao_dich' => now(),
            'trang_thai' => 'hoan_tat', // Hoặc trạng thái khác nếu cần
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Rút tiền thành công!',
            'so_du_moi' => $vi_tien->so_du
        ]);
    }


    // --------------------- ví tiền tài xế -----------------------------------

    public function getDataTaiXe() {}
    public function NapTien(Request $request) {}
    public function RutTien(Request $request) {}
}
