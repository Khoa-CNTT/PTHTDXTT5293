<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhachHangSeeding extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('khach_hangs')->delete();
        DB::table('khach_hangs')->truncate();
        DB::table('khach_hangs')->insert([
            [
                'ho_ten'     =>  'Canh',
                'email'         =>  'canh23@gmail.com',
                'so_dien_thoai' =>  '0123456789',
                'password'      =>  bcrypt('123456'),
                'trang_thai'     =>  1,
                'dia_chi'   => 'quảng nam'
            ],
            [
                'ho_ten'     =>  'Lê',
                'email'         =>  'le24@gmail.com',
                'so_dien_thoai' =>  '0123456789',
                'password'      =>  bcrypt('123456'),
                'trang_thai'     =>  1,
                'dia_chi'   => 'quảng nam'
            ],
            [
                'ho_ten'     =>  'Lưu',
                'email'         =>  'luu24@gmail.com',
                'so_dien_thoai' =>  '0123456789',
                'password'      =>  bcrypt('123456'),
                'trang_thai'     =>  1,
                'dia_chi'   => 'quảng nam'
            ],
            [
                'ho_ten'     =>  'Lann',
                'email'         =>  'lan24@gmail.com',
                'so_dien_thoai' =>  '0123456789',
                'password'      =>  bcrypt('123456'),
                'trang_thai'     =>  1,
                'dia_chi'   => 'quảng nam'
            ],
            [
                'ho_ten'     =>  'Lann',
                'email'         =>  'lan25@gmail.com',
                'so_dien_thoai' =>  '0123456789',
                'password'      =>  bcrypt('123456'),
                'trang_thai'     =>  1,
                'dia_chi'   => 'quảng nam'
            ],

        ]);
    }
}
