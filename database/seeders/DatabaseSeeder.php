<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            AdminSeeder::class,
            MaGiamGiaSeeding::class,
            KhachHangSeeding::class,
            TaiXeSeeding::class,
            ChiTietPhanQuyenSeeding::class,
            ChucNangSeeding::class,
            PhanQuyenSeeding::class
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
