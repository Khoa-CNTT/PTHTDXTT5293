<?php

namespace App\Http\Controllers;

use App\Http\Requests\CapNhatNhanVienRequest;
use App\Http\Requests\ThemNhanVienRequest;
use App\Models\ChiTietPhanQuyen;
use App\Models\PhanQuyen;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\QuanTriVien;
use Illuminate\Support\Facades\Auth;
use Phar;

class QuanTriVienController extends Controller
{
    // data
    public function getData()
    {

        $data = QuanTriVien::join('phan_quyens', 'quan_tri_viens.id_chuc_vu', '=', 'phan_quyens.id')
            ->select('quan_tri_viens.*', 'phan_quyens.ten_quyen')
            ->get();

        $data_quyen = PhanQuyen::get();

        return response()->json([
            'data' => $data,
            'data_quyen' => $data_quyen,
        ]);
    }

    // thêm mới nhân viên
    public function create(ThemNhanVienRequest $request)
    {
        $login = Auth::guard('sanctum')->user();

        QuanTriVien::create([
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'ho_ten'     => $request->ho_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi'       => $request->dia_chi,
            'tinh_trang'    => 1,
            'id_chuc_vu'    => $request->id_chuc_vu,
        ]);
        return response()->json([
            'status' => true,
            'message' => "Đã tạo mới nhân viên " . $request->ho_ten . " thành công.",
        ]);
    }

    // xóa nhân viên
    public function destroy(Request $request)
    {

        $data = QuanTriVien::find($request->id);

        if ($data->is_master == 1) {
            return response()->json([
                'status' => false,
                'message' => "Tài khoản master không thể xóa.",
            ]);
        }
        $data->delete();

        return response()->json([
            'status' => true,
            'message' => "Đã xóa nhân viên" . $request->ho_ten . " thành công.",
        ]);
    }

    // check email
    public function checkMail(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        $email = $request->email;
        $check = QuanTriVien::where('email', $email)->first();
        if ($check) {
            return response()->json([
                'status' => false,
                'message' => "Email này đã tồn tại.",
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => "Có thể thêm nhân viên này.",
            ]);
        }
    }

    // cập nhật nhân viên
    public function update(CapNhatNhanVienRequest $request)
    {
        $dangLogin = $this->isAdmin();
        $admin = QuanTriVien::find($request->id);
        if ($admin->is_master == 1 && $admin->id != $dangLogin->id) {
            return response()->json([
                'status'  =>  false,
                'message' =>  'Bạn không thể cập nhật Tài Khoản Có Quyền Hạn Cao'
            ]);
        }


        $admin->update([
            'email'         => $request->email,
            'ho_ten'        => $request->ho_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi'       => $request->dia_chi,
            'tinh_trang'    => $request->tinh_trang,
            'id_chuc_vu'    => $request->id_chuc_vu,
        ]);
        return response()->json([
            'status' => true,
            'message' => "Đã update nhân viên" . $request->ho_ten . " thành công.",
        ]);
    }

    // đổi tình trạng
    public function changeStatus(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        $nhanVien = QuanTriVien::where('id', $request->id)->first();

        if ($nhanVien) {
            if ($nhanVien->tinh_trang == 0) {
                $nhanVien->tinh_trang = 1;
            } else {
                $nhanVien->tinh_trang = 0;
            }
            $nhanVien->save();

            return response()->json([
                'status'    => true,
                'message'   => "Đã cập nhật trạng thái nhân viên thành công!"
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Nhân viên không tồn tại!"
            ]);
        }
    }

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
        // dd($Account_Login);
        if ($Account_Login && $Account_Login instanceof \App\Models\QuanTriVien) {
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
