<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lich_su_nap_ruts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(); // Khóa ngoại liên kết bảng users
            $table->integer('taixe_id')->nullable();
            $table->string('user_type')->nullable();
            //$table->enum('user_type', ['khach_hang', 'tai_xe']); // Loại người dùng
            $table->decimal('so_tien', 15, 2); // Số tiền chính xác
            $table->string('loai_giao_dich'); // Loại giao dịch
            $table->string('ngan_hang')->nullable();
            $table->string('so_tai_khoan')->nullable();
            $table->string('hinh_thuc')->nullable(); // Hình thức giao dịch (chuyển khoản, tiền mặt, v.v.)
            $table->enum('trang_thai', ['chua_xac_nhan', 'da_xac_nhan', 'hoan_tat'])->default('chua_xac_nhan'); // Trạng thái (chưa xác nhận, đã xác nhận, hoàn tất)
            //$table->integer('trang_thai'); // Trạng thái (0: chờ xử lý, 1: đã xử lý,...)
            $table->timestamp('ngay_giao_dich')->nullable(); // Ngày giờ giao dịch
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lich_su_nap_ruts');
    }
};
