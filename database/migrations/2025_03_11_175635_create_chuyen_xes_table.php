<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('chuyen_xes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('KhachHang_id');
            $table->unsignedBigInteger('TaiXe_id')->nullable();
            $table->unsignedBigInteger('Ma_id')->nullable(); // Nếu không bắt buộc có mã giảm giá
            $table->string('DiaDiemDon');
            $table->string('DiaDiemDen');
            $table->string('LoaiXe');
            $table->decimal('GiaTien', 10, 2);
            $table->dateTime('ThoiGian');
            $table->string('TrangThai')->default('Chưa đặt');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('chuyen_xes');
    }
};
