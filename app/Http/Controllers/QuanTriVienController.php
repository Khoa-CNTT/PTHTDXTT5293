<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\QuanTriVien;
use Illuminate\Support\Facades\Auth;

class QuanTriVienController extends Controller
{
    public function logIn(Request $request)
    {
        $check  =   Auth::guard('admin')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);

        if ($check) {
            // Lấy thông tin tài khoản đã đăng nhập thành công
            $admin  =   Auth::guard('admin')->user(); // Lấy được thông tin nhân viên đã đăng nhập

            return response()->json([
                'status'    => true,
                'message'   => "Đã đăng nhập thành công!",
                'token'     => $admin->createToken(name: 'token_admin')->plainTextToken,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Tài khoản hoặc mật khẩu không đúng!",
            ]);
        }
    }

    public function checkAdmin()
    {
        $Account_Login   = Auth::guard('sanctum')->user();
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
