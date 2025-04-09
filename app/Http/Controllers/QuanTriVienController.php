<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\QuanTriVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuanTriVienController extends Controller
{
    public function logIn(Request $request)
    {
        $check  =   Auth::guard('nhanvien')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);

        if ($check) {
            // Lấy thông tin tài khoản đã đăng nhập thành công
            $nhanVien  =   Auth::guard('nhanvien')->user(); // Lấy được thông tin nhân viên đã đăng nhập

            return response()->json([
                'status'    => true,
                'message'   => "Đã đăng nhập thành công!",
                'token'     => $nhanVien->createToken('token_nhan_vien')->plainTextToken,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Tài khoản hoặc mật khẩu không đúng!",
            ]);
        }
    }

    public function kiemTraAdmin()
    {
        $Account_Login   = Auth::guard('sanctum')->user();
        // Khi đang đăng nhập ở đây có thể là: Khách Hàng, Đại Lý, Admin
        // Chúng phải kiểm tra $tai_khoan_dang_dang_nhap có phải là tài khoản Admin/Nhân Viên hay kihoong?
        if ($Account_Login && $$Account_Login instanceof \App\Models\QuanTriVien) {
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
}
