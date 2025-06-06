<?php

namespace App\Http\Controllers;

use App\Http\Requests\CapNhatTaiKhoanKhangHangRequest;
use App\Http\Requests\KhachHangDangkyRequest;
use App\Http\Requests\KhachHangDangNhapRequest;
use App\Http\Requests\KhachHangDoiMatKhauRequest;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\MasterMail;
use Illuminate\Support\Facades\Mail;

class KhachHangController extends Controller
{
    public function getDataUser()
    {
        $data = KhachHang::get();
        return response()->json([
            'data' => $data
        ]);
    }

    // đăng xuất
    public function logoutUser()
    {
        // Lấy thông tin người dùng đang đăng nhập
        $Account_Login = Auth::guard('sanctum')->user();

        // Kiểm tra xem người dùng có đăng nhập hay không
        if ($Account_Login) {
            // Hủy token xác thực của người dùng để đăng xuất
            $Account_Login->tokens->each(function ($token) {
                $token->delete();
            });
            return response()->json([
                'status'    => true,
                'message'   => "Đăng xuất thành công!",
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => "Người dùng chưa đăng nhập!",
            ]);
        }
    }
    // đăng ký
    public function registerUser(KhachHangDangkyRequest $request)
    {
        $KhachHang = KhachHang::create([
            'ho_ten'                => $request->ho_ten,
            'so_dien_thoai'         => $request->so_dien_thoai,
            'email'                 => $request->email,
            'dia_chi'                 => $request->dia_chi,
            'password'              => bcrypt($request->password)

        ]);

        return response()->json([
            'status' => true,
            'message' => "Đăng Kí Tài Khoản Thành Công!"
        ]);
    }
    // đăng nhập
    public function loginUser(KhachHangDangNhapRequest $request)
    {
        $check = Auth::guard('khachhang')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);

        if ($check) {
            $khach_hang = Auth::guard('khachhang')->user();

            return response()->json([
                'status'    => true,
                'message'   => "Đã đăng nhập thành công!",
                'token'     => $khach_hang->createToken('token_khach_hang')->plainTextToken,
                'ten_kh'    => $khach_hang->ho_ten
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Tài khoản hoặc mật khẩu không đúng!"
            ]);
        }
    }
    // đổi mật khẩu
    public function changePassword(KhachHangDoiMatKhauRequest $request)
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

    // cập nhật tk
    public function updateAccount(CapNhatTaiKhoanKhangHangRequest $request)
    {
        $Account_Login   = Auth::guard('sanctum')->user();
        if (!$Account_Login) {
            return response()->json([
                'status'  => false,
                'message' => "Người dùng không tồn tại!"
            ]);
        }

        // Lấy dữ liệu cần cập nhật
        $updateData = $request->only(['ho_ten', 'so_dien_thoai', 'email', 'dia_chi']);

        // Thực hiện cập nhật
        $Account_Login->update($updateData);

        return response()->json([
            'status'  => true,
            'message' => "Đã cập nhật tài khoản thành công!",
            'user'    => $Account_Login
        ]);
    }

    // kiem tra khách hàng
    public function checkCustomer()
    {
        $Account_Login   = Auth::guard('sanctum')->user();
        if ($Account_Login && $Account_Login instanceof \App\Models\KhachHang) {
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

    // kích hoạt tk khách hàng
    public function activateAccount(Request $request)
    {
        // nào làm phân quyền rồi bỏ cái này

        // $login = Auth::guard('sanctum')->user();
        // $khach_hang = KhachHang::where('id', $request->id)->first();

        // if ($khach_hang) {
        //     if ($khach_hang->is_active == 0) {
        //         $khach_hang->is_active = 1;
        //         $khach_hang->save();

        //         return response()->json([
        //             'status' => true,
        //             'message' => "Đã kích hoạt tài khoản thành công!"
        //         ]);
        //     }
        // } else {
        //     return response()->json([
        //         'status' => false,
        //         'message' => "Có lỗi xảy ra!"
        //     ]);
        // }
    }
    public function getDataProfile()
    {
        $Account_Login   = Auth::guard('sanctum')->user();
        return response()->json([
            'data'    =>  $Account_Login
        ]);
    }
    // xóa tk
    public function deleteAccount(Request $request)
    {
        $User = KhachHang::Where('id', $request->id)->first();

        if ($User) {
            $User->delete();
            return response()->json([
                'status' => true,
                'message' => "Đã xóa tài khoản thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Xóa tài khoản không thành công!"
            ]);
        }
    }

    // đổi trạng thái tài khoản khách hàng
    public function changeStatus(Request $request)
    {

        $khach_hang = KhachHang::where('id', $request->id)->first();

        if ($khach_hang) {
            $khach_hang->trang_thai = !$khach_hang->trang_thai;
            $khach_hang->save();
            return response()->json([
                'status' => true,
                'message' => "Đã đổi trạng thái tài khoản thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Đã xảy ra lỗi khi thay đổi trạng thái tài khoản!"
            ]);
        }
    }
    // update tài khoản khách hàng ( admin)
    public function update(Request $request)
    {
        $khach_hang = KhachHang::where('id', $request->id)->first();
        if ($khach_hang) {
            $khach_hang->update([
                'ho_ten'         => $request->ho_ten,
                'so_dien_thoai'     => $request->so_dien_thoai,
                'email'             => $request->email,
                'dia_chi'           => $request->dia_chi,
                'vi_tien'           => $request->vi_tien,
            ]);
            return response()->json([
                'status' => true,
                'message' => "Đã cập nhật tài khoản thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra khi cập nhật!"
            ]);
        }
    }

    // delete tài khoản khách hàng ( admin)
    public function delete(Request $request)
    {
        $khach_hang = KhachHang::where('id', $request->id)->first();
        if ($khach_hang) {
            $khach_hang->delete();
            return response()->json([
                'status' => true,
                'message' => "Bạn đã xóa tài khoản thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra khi xóa tài khoản!"
            ]);
        }
    }
    public function getAvatar(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $data = $request->all();
        $file = $data['hinh_anh'];
        //$file_name = $file->getClientOriginalName(); // lay ten file
        $file_extension = $file->getClientOriginalExtension();
        $file_name = Str::slug($user->ho_ten) . "."  . $file_extension;
        $cho_luu = "KhachHangAVT\\" . $file_name;
        $file->move("KhachHangAVT", $file_name);
        $hinh_anh = "http://127.0.0.1:8000/" . $cho_luu;

        KhachHang::find($user->id)->update([
            'hinh_anh' => $hinh_anh
        ]);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã đổi ảnh đại diện thành công'
        ]);
    }

    // quên mk
    public function forgotPassword(Request $request)
    {
        $khach_hang = KhachHang::where('email', $request->email)->first();
        if ($khach_hang) {
            $hash_reset         = Str::uuid();
            $x['ho_ten']     = $khach_hang->ho_ten;
            $x['link']          = 'http://localhost:5173/khach-hang/doi-mat-khau/' . $hash_reset;
            Mail::to($request->email)->send(new MasterMail('Đổi Mật Khẩu Của Bạn', 'quen_mat_khau', $x));
            $khach_hang->hash_reset = $hash_reset;
            $khach_hang->save();
            return response()->json([
                'status'    =>  true,
                'message'   =>  'Vui Lòng kiểm tra lại email'
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Email không có trong hệ thống'
            ]);
        }
    }
}
