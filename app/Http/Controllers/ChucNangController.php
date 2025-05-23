<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhanQuyen;
use App\Models\ChucNang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChucNangController extends Controller
{
    public function getData()
    {
        $chuc_nang_id = 38;
        $login = Auth::guard('sanctum')->user();
        $quyen_id = $login->$chuc_nang_id;
        $check_quyen = ChiTietPhanQuyen::where('quyen_id', $quyen_id)
            ->where('chuc_nang_id', $chuc_nang_id)
            ->first();
        if ($check_quyen) {
            return response()->json([
                'data' => false,
                'message' => "bạn không có quyền thực hiện chức năng này!"
            ]);
        }
        $data = ChucNang::get();

        return response()->json([
            'data' => $data
        ]);
    }
}
