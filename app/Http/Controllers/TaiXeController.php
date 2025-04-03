<?php

namespace App\Http\Controllers;

use App\Models\TaiXe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function LogIn(Request $request)
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
    public function registerDriver(Request $request)
    {
        $TaiXe = TaiXe::create([
            'ho_ten'                => $request->ho_ten,
            'so_dien_thoai'         => $request->so_dien_thoai,
            'email'                 => $request->email,
            'password'              => bcrypt($request->password),
            'dia_chi'                 => $request->dia_chi,
            'loai_xe'                 => $request->loai_xe,
            'bien_so'                 => $request->bien_so,

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
            if ($TaiXe) {
                $TaiXe->tinh_trang == 0;
            } else {
                $TaiXe->tinh_trang == 1;
            }
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

    // update  tài xế (admin)
    public function updateAcount(Request $request)
    {
        $TaiXe = TaiXe::find($request->id)->update([
            'ho_ten'                => $request->ho_ten,
            'so_dien_thoai'         => $request->so_dien_thoai,
            'email'                 => $request->email,
            'cccd'                  => $request->cccd,
            'loai_xe'               => $request->loai_xe,
            'bien_so'               => $request->bien_so,
            'bang_lai_xe'           => $request->bang_lai_xe,
            'thong_tin_khach'       => $request->thong_tin_khach,
            'ngan_hang'            => $request->ngan_hang,
        ]);
        return response()->json([
            'status' => true,
            'message' => "Đã update tài xế" . $request->ho_ten . " thành công.",
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
}
