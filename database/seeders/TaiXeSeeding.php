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
                "cccd"              => '012345623921',
                "ngan_hang"             => '1900123456232',
                "bang_lai_xe"           => 'A1-123456987',
                'trang_thai'        =>  1,
            ],
            [
                'email'             =>  'ly123456@gmail.com',
                'password'          =>  bcrypt('123456'),
                'ho_ten'            =>  'Lý',
                'so_dien_thoai'     =>  '0123456789',
                'dia_chi'           =>  'Đà Nẵng',
                "loai_xe"           => 'Ô tô',
                "bien_so"           => '51C-122.66',
                "cccd"              => '012345623911',
                "ngan_hang"         => '1900123456232',
                "bang_lai_xe"       => 'A1-123456987',
                'trang_thai'        =>  1,
            ],
            [
                'email'             =>  'lydat666@gmail.com',
                'password'          =>  bcrypt('123456'),
                'ho_ten'            =>  'Lý Đạo',
                'so_dien_thoai'     =>  '0123456789',
                'dia_chi'           =>  'Đà Nẵng',
                "loai_xe"           => 'Ô tô',
                "bien_so"           => '51C-122.66',
                "cccd"              => '0123456131111',
                "ngan_hang"         => '1900123456232',
                "bang_lai_xe"       => 'A1-123456987',
                'trang_thai'        =>  1,
            ],
            [
                'email'             =>  'lydat667@gmail.com',
                'password'          =>  bcrypt('123456'),
                'ho_ten'            =>  'Lý Đạo 2',
                'so_dien_thoai'     =>  '0123456789',
                'dia_chi'           =>  'Đà Nẵng',
                "loai_xe"           => 'Ô tô',
                "bien_so"           => '51C-122.66',
                "cccd"              => '012345613121',
                "ngan_hang"         => '1900123456212',
                "bang_lai_xe"       => 'A1-123456987',
                'trang_thai'        =>  1,
            ],
            [
                'email'             =>  'lydat668@gmail.com',
                'password'          =>  bcrypt('123456'),
                'ho_ten'            =>  'Lý Đạo 3',
                'so_dien_thoai'     =>  '0123456789',
                'dia_chi'           =>  'Đà Nẵng',
                "loai_xe"           => 'Ô tô',
                "bien_so"           => '51C-122.66',
                "cccd"              => '012342212211',
                "ngan_hang"         => '1900123456232',
                "bang_lai_xe"       => 'A1-123456987',
                'trang_thai'        =>  1,
            ]
        ]);
    }
}
