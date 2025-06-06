<?php

namespace App\Http\Controllers;

use App\Http\Requests\CapNhatTaiKhoanTaiXeRequest;
use App\Http\Requests\TaiXeDangKyRequest;
use App\Http\Requests\TaiXeDangNhapRequest;
use App\Http\Requests\TaiXeDoiMatKhauRequest;
use App\Models\TaiXe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TaiXeController extends Controller
{

    public function getData()
    {
        $data = TaiXe::get();
        return response()->json([
            'data' => $data
        ]);
    }

    // đăng nhập
    public function LogIn(TaiXeDangNhapRequest $request)
    {
        $Check_Taixe = Auth::guard("taixe")->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);

        if ($Check_Taixe) {
            $Tai_xe = Auth::guard("taixe")->user();
            return response()->json([
                'status' => true,
                'message' => "Đã đăng nhập thành công!",
                'token' => $Tai_xe->createToken('token_tai_xe')->plainTextToken,
                'ten_taixe'    => $Tai_xe->ho_ten
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Tài khoản hoặc mật khẩu không đúng!"
            ]);
        }
    }

    // đăng ký
    public function registerDriver(TaiXeDangKyRequest $request)
    {
        $TaiXe = TaiXe::create([
            'ho_ten'        => $request->ho_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'dia_chi'       => $request->dia_chi,
            'cccd'          => $request->cccd,
            'loai_xe'       => $request->loai_xe,
            'bien_so'       => $request->bien_so,
            'bang_lai_xe'   => $request->bang_lai_xe,
            'ngan_hang'   => $request->ngan_hang,

        ]);
        return response()->json([
            'status' => true,
            'message' => "Đăng Kí Tài Khoản Thành Công!"
        ]);
    }
    // đổi tình trạng tài xế (admin)
    public function changeDriver(Request $request)
    {
        $TaiXe = TaiXe::where('id', $request->id)->first();

        if ($TaiXe) {
            $TaiXe->trang_thai = !$TaiXe->trang_thai;
            $TaiXe->save();
            return response()->json([
                'status'    => true,
                'message'   => "Đã cập nhật tình trạng tài xế thành công!"
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Tài xế không tồn tại!"
            ]);
        }
    }

    // update  tài xế ( profile)
    public function updateAcount(CapNhatTaiKhoanTaiXeRequest $request)
    {
        $Account_Login   = Auth::guard('sanctum')->user();
        if (!$Account_Login) {
            return response()->json([
                'status'  => false,
                'message' => "Người dùng không tồn tại!"
            ]);
        }

        // Lấy dữ liệu cần cập nhật
        $updateData = $request->only(['ho_ten', 'so_dien_thoai', 'email', 'dia_chi', 'cccd', 'loai_xe', 'bien_so', 'bang_lai_xe', 'ngan_hang']);

        // Thực hiện cập nhật
        $Account_Login->update($updateData);

        return response()->json([
            'status'  => true,
            'message' => "Đã cập nhật tài khoản thành công!",
            'user'    => $Account_Login
        ]);
    }

    // delete tài xế (admin)
    public function deleteAcount(Request $request)
    {
        TaiXe::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => "Đã xóa tài xế" . $request->ho_ten . " thành công.",
        ]);
    }

    // cập nhật tài xế (admin)
    public function update(Request $request)
    {
        $Account_Login = Auth::guard('sanctum')->user();
        TaiXe::find($request->id)->update([
            'ho_ten'                => $request->ho_ten,
            'so_dien_thoai'         => $request->so_dien_thoai,
            'email'                 => $request->email,
            'cccd'                  => $request->cccd,
            'loai_xe'               => $request->loai_xe,
            'bien_so'               => $request->bien_so,
            'bang_lai_xe'           => $request->bang_lai_xe,
            'ngan_hang'            => $request->ngan_hang,

        ]);
        return response()->json([
            'status' => true,
            'message' => "Cập nhật thông tin tài xế thành công!",
        ]);
    }
    // đổi mật khẩu
    public function changePassword(TaiXeDoiMatKhauRequest $request)
    {
        // kiểm tra tk đăng nhập
        $Account_Login = Auth::guard('sanctum')->user();

        if (!$Account_Login) {
            return response()->json([
                'status' => false,
                'message' => 'Người dùng chưa đăng nhập!'
            ], 401);
        }

        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->old_password, $Account_Login->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Mật khẩu cũ không chính xác!'
            ]);
        }

        // Kiểm tra mật khẩu mới có trùng với mật khẩu hiện tại không
        if (Hash::check($request->new_password, $Account_Login->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Mật khẩu mới không được trùng với mật khẩu hiện tại!'
            ]);
        }

        // Cập nhật mật khẩu mới
        $Account_Login->password = Hash::make($request->new_password);
        $Account_Login->save();

        return response()->json([
            'status' => true,
            'message' => 'Mật khẩu đã được thay đổi thành công!'
        ]);
    }
    // thêm tài xế ( admin ) -- có thể bỏ k dùng
    // public function create(Request $request)
    // {
    //     $Account_Login = Auth::guard('sanctum')->user();
    //     TaiXe::create([
    //         'ho_ten'                => $request->ho_ten,
    //         'so_dien_thoai'         => $request->so_dien_thoai,
    //         'email'                 => $request->email,
    //         'cccd'                  => $request->cccd,
    //         'loai_xe'               => $request->loai_xe,
    //         'bien_so'               => $request->bien_so,
    //         'bang_lai_xe'           => $request->bang_lai_xe,
    //         'ngan_hang'            => $request->ngan_hang,

    //     ]);
    //     return response()->json([
    //         'status' => true,
    //         'message' => "Đã tạo mới tài xế " . $request->ho_ten . " thành công.",
    //     ]);
    // }

    // kiểm tra tài khoản tài xế
    public function checkDriver()
    {
        $Account_Login   = Auth::guard('sanctum')->user();
        if ($Account_Login && $Account_Login instanceof \App\Models\TaiXe) {
            return response()->json([
                'status'    =>  true
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn cần đăng nhập hệ thống trước'
            ]);
        }
    }

    // profile
    public function getDataProfile()
    {
        $Account_Login   = Auth::guard('sanctum')->user();
        return response()->json([
            'data'    =>  $$Account_Login
        ]);
    }
}
