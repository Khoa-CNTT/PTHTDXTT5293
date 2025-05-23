<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quan_tri_viens')->delete();

        DB::table('quan_tri_viens')->truncate();

        DB::table('quan_tri_viens')->insert([
            [
                'email'             =>  'admin@gmail.com',
                'password'          =>  bcrypt('123456'),
                'ho_ten'            =>  'Cảnh',
                'so_dien_thoai'     =>  '0383565535',
                'dia_chi'           =>  'Đà Nẵng',
                'tinh_trang'        =>  1,
                'id_chuc_vu'        =>  1,
                'is_master'         =>  1,
            ],
            [
                'email'             =>  'ly@gmail.com',
                'password'          =>  bcrypt('123456'),
                'ho_ten'            =>  'ly',
                'so_dien_thoai'     =>  '0383565535',
                'dia_chi'           =>  'Đà Nẵng',
                'tinh_trang'        =>  1,
                'id_chuc_vu'        =>  2,
                'is_master'         =>  0,
            ],

        ]);
    }
}
