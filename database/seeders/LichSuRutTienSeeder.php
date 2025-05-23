<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LichSuRutTienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lich_su_nap_ruts')->delete();

        DB::table('lich_su_nap_ruts')->truncate();

        DB::table('lich_su_nap_ruts')->insert([
            [
                'user_id' => 1,
                'taixe_id' => 1,
                'user_type' => 'khach_hang',
                'so_tien' => 120000.00,
                'loai_giao_dich' => 'nap_tien',
                'ngan_hang' => 'Vietcombank',
                'so_tai_khoan' => '123456789',
                'trang_thai' => 0,
                'ngay_giao_dich' => Carbon::now()->subDays(2)->toDateString(),
            ],
            [
                'user_id' => 2,
                'taixe_id' => 2,
                'user_type' => 'tai_xe',
                'so_tien' => 250000.00,
                'loai_giao_dich' => 'rut_tien',
                'ngan_hang' => 'Techcombank',
                'so_tai_khoan' => '987654321',
                'trang_thai' => 1,
                'ngay_giao_dich' => Carbon::now()->subDays(1)->toDateString(),
            ],
            [
                'user_id' => 3,
                'taixe_id' => 1,
                'user_type' => 'khach_hang',
                'so_tien' => 30000.00,
                'loai_giao_dich' => 'thanh_toan',
                'ngan_hang' => 'Techcombank',
                'so_tai_khoan' => '987652321',
                'trang_thai' => 2,
                'ngay_giao_dich' => Carbon::now()->toDateString(),
            ],
            [
                'user_id' => 4,
                'taixe_id' => 4,
                'user_type' => 'tai_xe',
                'so_tien' => 150000.00,
                'loai_giao_dich' => 'thu_thuong',
                'ngan_hang' => 'ACB',
                'so_tai_khoan' => '567890123',
                'trang_thai' => 2,
                'ngay_giao_dich' => Carbon::now()->subDays(3)->toDateString(),
            ],
            [
                'user_id' => 4,
                'taixe_id' => 5,
                'user_type' => 'khach_hang',
                'so_tien' => 85000.00,
                'loai_giao_dich' => 'thanh_toan',
                'ngan_hang' => 'BIDV',
                'so_tai_khoan' => '9988776655',
                'trang_thai' => 1,
                'ngay_giao_dich' => Carbon::now()->subDays(4)->toDateString(),
            ],
            [
                'user_id' => 5,
                'taixe_id' => 2,
                'user_type' => 'khach_hang',
                'so_tien' => 50000.00,
                'loai_giao_dich' => 'nap_tien',
                'ngan_hang' => 'Vietinbank',
                'so_tai_khoan' => '1122334455',
                'trang_thai' => 0,
                'ngay_giao_dich' => Carbon::now()->subDays(5)->toDateString(),
            ],
            [
                'user_id' => null,
                'taixe_id' => 3,
                'user_type' => 'tai_xe',
                'so_tien' => 47000.00,
                'loai_giao_dich' => 'rut_tien',
                'ngan_hang' => 'Sacombank',
                'so_tai_khoan' => '4433221100',
                'trang_thai' => 2,
                'ngay_giao_dich' => Carbon::now()->subDays(6)->toDateString(),
            ],
            [
                'user_id' => 6,
                'taixe_id' => 3,
                'user_type' => 'khach_hang',
                'so_tien' => 99000.00,
                'loai_giao_dich' => 'thanh_toan',
                'ngan_hang' => 'Techcombank',
                'so_tai_khoan' => '987652321',
                'trang_thai' => 1,
                'ngay_giao_dich' => Carbon::now()->subDays(7)->toDateString(),
            ],
        ]);
    }
}
