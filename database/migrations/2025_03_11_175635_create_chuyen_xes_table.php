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
            $table->string('TaiXe')->nullable();
            $table->text('DiaDiemDon');
            $table->text('DiaDiemDen');
            $table->integer('LoaiXe')->comment('1: Xe Máy, 2: Xe 4 Chỗ, 3: 7 Chỗ, 4: Xe 4 chỗ Luxury, 5: 7 Chỗ Luxury');
            $table->decimal('GiaTien', 10, 2);
            $table->string('BienSo')->nullable();   // biển số xe
            $table->string('DichVu')->nullable();
            $table->float('SoKm')->nullable();      // số km đã đi
            $table->integer('HinhThucThanhToan')->nullable();
            $table->integer('TrangThai')->default(0)->comment('0: Chưa hoàn thành, 1: Hoàn Thành');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('chuyen_xes');
    }
};
