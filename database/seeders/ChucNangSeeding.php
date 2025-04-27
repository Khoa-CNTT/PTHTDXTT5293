<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucNangSeeding extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chuc_nangs')->delete();

        DB::table('chuc_nangs')->truncate();

        DB::table('chuc_nangs')->insert([
            // Chuyến xe
            ['id' => '1', 'ten_chuc_nang' => 'Tạo Mới Đơn Đặt Xe'],
            ['id' => '2', 'ten_chuc_nang' => 'Tài xế nhận chuyến xe.'],
            ['id' => '3', 'ten_chuc_nang' => 'Lấy danh sách tất cả đơn đặt xe.'],
            ['id' => '4', 'ten_chuc_nang' => 'Cập nhật trạng thái đơn đặt xe.'],
            ['id' => '5', 'ten_chuc_nang' => 'Xóa đơn đặt xe.'],
            ['id' => '6', 'ten_chuc_nang' => 'Lấy danh sách tất cả đơn đặt xe của tài xế.'],
            ['id' => '7', 'ten_chuc_nang' => 'Cập nhật trạng thái đơn đặt xe của tài xế.'],
            ['id' => '8', 'ten_chuc_nang' => 'Xác nhận đơn đặt xe.'],
            ['id' => '9', 'ten_chuc_nang' => 'Lấy danh sách đơn đặt xe của khách hàng.'],
            ['id' => '10', 'ten_chuc_nang' => 'Xem chi tiết đơn đặt xe.'],
            ['id' => '11', 'ten_chuc_nang' => 'Hủy đơn đặt xe.'],
            ['id' => '12', 'ten_chuc_nang' => 'Đánh giá tài xế.'],
            ['id' => '13', 'ten_chuc_nang' => 'Xem lịch sử chuyến xe.'],
            // Đánh giá
            ['id' => '14', 'ten_chuc_nang' => 'Lấy danh sách tất cả đánh giá.'],
            ['id' => '15', 'ten_chuc_nang' => 'Thêm đánh giá tài xế.'],
            ['id' => '16', 'ten_chuc_nang' => 'Xóa đánh giá tài xế.'],
            ['id' => '17', 'ten_chuc_nang' => 'Cập nhật đánh giá tài xế.'],
            // Lịch sử nạp rút
            ['id' => '18', 'ten_chuc_nang' => 'Xóa lịch sử giao dịch.'],
            ['id' => '19', 'ten_chuc_nang' => 'Cập nhật trạng thái giao dịch.'],
            ['id' => '20', 'ten_chuc_nang' => 'Lấy tất cả lịch sử nạp rút tài xế'],
            ['id' => '21', 'ten_chuc_nang' => 'Nạp tiền tài xế'],
            ['id' => '22', 'ten_chuc_nang' => 'Rút tiền tài xế'],
            // Mã giảm giá
            ['id' => '23', 'ten_chuc_nang' => 'Lấy tất cả mã giảm giá.'],
            ['id' => '24', 'ten_chuc_nang' => 'Thêm mới mã giảm giá.'],
            ['id' => '25', 'ten_chuc_nang' => 'Xóa mã giảm giá.'],
            ['id' => '26', 'ten_chuc_nang' => 'Cập nhật mã giảm giá.'],
            ['id' => '27', 'ten_chuc_nang' => 'Đổi tình trạng mã giảm giá.'],
            // Phân quyền
            ['id' => '28', 'ten_chuc_nang' => 'Lấy Danh Sách Phân Quyền.'],
            ['id' => '29', 'ten_chuc_nang' => 'Tạo Mới Phân Quyền.'],
            ['id' => '30', 'ten_chuc_nang' => 'Cập Nhật Phân Quyền.'],
            ['id' => '31', 'ten_chuc_nang' => 'Xóa Phân Quyền.'],
            // quản trị viên
            ['id' => '32', 'ten_chuc_nang' => 'Quản Lý Đơn Đặt Xe'],
            ['id' => '33', 'ten_chuc_nang' => 'Quản Lý Phản Hồi Chatbot'],
            ['id' => '34', 'ten_chuc_nang' => 'Cập Nhật Trạng Thái Đơn Đặt Xe'],
            ['id' => '35', 'ten_chuc_nang' => 'Thống Kê Số Lượng Đơn Đặt Xe'],
            ['id' => '36', 'ten_chuc_nang' => 'Tạo Mới Chi Tiết Phân Quyền'],
            ['id' => '37', 'ten_chuc_nang' => 'Lấy Danh Sách Chi Tiết Phân Quyền'],
            // Tài xế
            ['id' => '38', 'ten_chuc_nang' => 'Đổi trạng thái tài xế.'],
        ]);
    }
}
