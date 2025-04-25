<?php

namespace App\Http\Controllers;

use App\Models\ViTien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViTienController extends Controller
{
    public function getSoDu()
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn chưa đăng nhập!'
            ]);
        }

        $vi_tien = ViTien::where('user_id', $user->id)->first();

        if (!$vi_tien) {
            return response()->json([
                'status' => true,
                'message' => 'Ví tiền chưa được khởi tạo.',
                'so_du' => 0
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Lấy số dư thành công',
            'so_du' => $vi_tien->so_du
        ]);
    }

    public function getSoDuDriver()
    {
        $driver = Auth::guard('sanctum')->user();

        if (!$driver) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn chưa đăng nhập!'
            ]);
        }

        $vi_tien = ViTien::where('taixe_id', $driver->id)->first();

        if (!$vi_tien) {
            return response()->json([
                'status' => true,
                'message' => 'Ví tiền chưa được khởi tạo.',
                'so_du' => 0
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Lấy số dư thành công',
            'so_du' => $vi_tien->so_du
        ]);
    }
}
