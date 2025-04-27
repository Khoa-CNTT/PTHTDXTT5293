<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaGiamGiaSeeding extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ma_giam_gias')->delete();

        DB::table('ma_giam_gias')->truncate();

        DB::table('ma_giam_gias')->insert([
            [
                'code' => 'DISCOUNT01',
                'tinh_trang' => 1,
                'ngay_bat_dau' => '2025-01-01',
                'ngay_het_han' => '2025-01-30',
                'loai_giam_gia' => 0,
                'so_giam_gia' => 100000,
                'so_tien_toi_da' => 5000000,
                'so_tien_toi_thieu' => 2500000,
            ],
            [
                'code' => 'DISCOUNT02',
                'tinh_trang' => 0,
                'ngay_bat_dau' => '2025-01-15',
                'ngay_het_han' => '2025-02-15',
                'loai_giam_gia' => 1,
                'so_giam_gia' => 20000,
                'so_tien_toi_da' => 200000,
                'so_tien_toi_thieu' => 80000,
            ],
            [
                'code' => 'DISCOUNT03',
                'tinh_trang' => 1,
                'ngay_bat_dau' => '2025-02-20',
                'ngay_het_han' => '2025-03-20',
                'loai_giam_gia' => 0,
                'so_giam_gia' => 150000,
                'so_tien_toi_da' => 1500000,
                'so_tien_toi_thieu' => 750000,
            ],
            [
                'code' => 'DISCOUNT04',
                'tinh_trang' => 0,
                'ngay_bat_dau' => '2025-03-05',
                'ngay_het_han' => '2025-04-25',
                'loai_giam_gia' => 1,
                'so_giam_gia' => 30000,
                'so_tien_toi_da' => 3000000,
                'so_tien_toi_thieu' => 1000000,
            ],
            [
                'code' => 'DISCOUNT05',
                'tinh_trang' => 1,
                'ngay_bat_dau' => '2025-04-09',
                'ngay_het_han' => '2025-05-10',
                'loai_giam_gia' => 0,
                'so_giam_gia' => 15000,
                'so_tien_toi_da' => 250000,
                'so_tien_toi_thieu' => 100000,
            ],
        ]);
    }
}
