<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietPhanQuyenSeeding extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chi_tiet_phan_quyens')->delete();

        DB::table('chi_tiet_phan_quyens')->truncate();

        DB::table('chi_tiet_phan_quyens')->insert([
            ['chuc_nang_id' => '1', 'quyen_id' => 1],
            ['chuc_nang_id' => '2', 'quyen_id' => 1],
            ['chuc_nang_id' => '3', 'quyen_id' => 1],
            ['chuc_nang_id' => '4', 'quyen_id' => 1],
            ['chuc_nang_id' => '5', 'quyen_id' => 1],
            ['chuc_nang_id' => '6', 'quyen_id' => 1],
            ['chuc_nang_id' => '8', 'quyen_id' => 1],
            ['chuc_nang_id' => '7', 'quyen_id' => 1],
            ['chuc_nang_id' => '9', 'quyen_id' => 1],
            ['chuc_nang_id' => '10', 'quyen_id' => 1],
            ['chuc_nang_id' => '11', 'quyen_id' => 1],
            ['chuc_nang_id' => '12', 'quyen_id' => 1],
            ['chuc_nang_id' => '13', 'quyen_id' => 1],
            ['chuc_nang_id' => '14', 'quyen_id' => 1],
            ['chuc_nang_id' => '15', 'quyen_id' => 1],
            ['chuc_nang_id' => '16', 'quyen_id' => 1],
            ['chuc_nang_id' => '17', 'quyen_id' => 1],
            ['chuc_nang_id' => '18', 'quyen_id' => 1],
            ['chuc_nang_id' => '19', 'quyen_id' => 1],
            ['chuc_nang_id' => '20', 'quyen_id' => 1],
            ['chuc_nang_id' => '21', 'quyen_id' => 1],
            ['chuc_nang_id' => '22', 'quyen_id' => 1],
            ['chuc_nang_id' => '23', 'quyen_id' => 1],
            ['chuc_nang_id' => '24', 'quyen_id' => 1],
            ['chuc_nang_id' => '25', 'quyen_id' => 1],
            ['chuc_nang_id' => '26', 'quyen_id' => 1],
            ['chuc_nang_id' => '27', 'quyen_id' => 1],
            ['chuc_nang_id' => '28', 'quyen_id' => 1],
            ['chuc_nang_id' => '29', 'quyen_id' => 1],
            ['chuc_nang_id' => '30', 'quyen_id' => 1],
            ['chuc_nang_id' => '31', 'quyen_id' => 1],
            ['chuc_nang_id' => '32', 'quyen_id' => 1],
            ['chuc_nang_id' => '33', 'quyen_id' => 1],
            ['chuc_nang_id' => '34', 'quyen_id' => 1],
            ['chuc_nang_id' => '35', 'quyen_id' => 1],
            ['chuc_nang_id' => '36', 'quyen_id' => 1],
            ['chuc_nang_id' => '37', 'quyen_id' => 1],
        ]);
    }
}
