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
            $table->foreignId('user_id'); // Khóa ngoại liên kết bảng users
            $table->enum('user_type', ['khach_hang', 'tai_xe']); // Loại người dùng
            $table->decimal('so_tien', 15, 2); // Số tiền chính xác
            $table->enum('loai_giao_dich', ['Nạp tiền', 'Rút tiền']); // Loại giao dịch
            $table->string('hinh_thuc')->nullable(); // Hình thức giao dịch (chuyển khoản, tiền mặt, v.v.)
            $table->integer('trang_thai'); // Trạng thái (0: chờ xử lý, 1: đã xử lý,...)
            $table->timestamp('ngay_giao_dich')->nullable(); // Ngày giờ giao dịch
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lich_su_nap_ruts');
    }
};
