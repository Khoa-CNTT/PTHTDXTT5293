<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaiXeSeeding extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tai_xes')->delete();

        DB::table('tai_xes')->truncate();

        DB::table('tai_xes')->insert([
            [
                'email'             =>  'canh230103@gmail.com',
                'password'          =>  bcrypt('123456'),
                'ho_ten'         =>  'Cảnh',
                'so_dien_thoai'     =>  '0123456789',
                'dia_chi'           =>  'Đà Nẵng',
                "loai_xe"           => 'Ô tô',
                "bien_so"           => '51C-122.66',
                "cccd"              => '012345613921',
                "ngan_hang"             => '1900123456232',
                "bang_lai_xe"           => 'A1-123456987',
                'trang_thai'        =>  1,
            ],
        ]);
    }
}
