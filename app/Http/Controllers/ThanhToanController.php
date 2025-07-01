<?php

namespace App\Http\Controllers;

use App\Models\ChuyenXe;
use App\Models\ThanhToan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThanhToanController extends Controller
{
    public function Pay(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $don  = ChuyenXe::where('KhachHang_id', $user->id)
                        ->where('id', $request->id)
                        ->first();

        if (!$don) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy đơn này.'
            ]);
        }

        $don->update([
            'TrangThai' => 1
        ]);

        return response()->json([
            'status' => true,
            'message' => "Bạn đã thanh toán chuyến xe thành công!."
        ]);
    }
}
