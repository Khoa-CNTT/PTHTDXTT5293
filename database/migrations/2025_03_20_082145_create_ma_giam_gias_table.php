<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ma_giam_gias', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã giảm giá, không trùng lặp
            $table->integer('tinh_trang')->default(1); // Trạng thái (1: Hoạt động, 0: Hết hạn, ...)
            $table->date('ngay_bat_dau')->nullable(); // Ngày bắt đầu hiệu lực
            $table->date('ngay_het_han')->nullable(); // Ngày hết hạn
            $table->integer('loai_giam_gia'); // Loại giảm giá (1: %, 2: số tiền cố định)
            $table->integer('so_giam_gia'); // Giá trị giảm giá (số tiền hoặc %)
            $table->integer('so_tien_toi_da')->nullable(); // Giảm tối đa (nếu giảm theo %)
            $table->integer('so_tien_toi_thieu')->nullable(); // Giá trị đơn hàng tối thiểu
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ma_giam_gias');
    }
};
