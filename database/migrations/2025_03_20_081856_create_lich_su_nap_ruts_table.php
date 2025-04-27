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
            $table->integer('user_id')->nullable();
            $table->integer('taixe_id')->nullable();
            $table->string('user_type')->nullable();
            $table->decimal('so_tien', 15, 2);
            $table->string('loai_giao_dich');
            $table->string('ngan_hang')->nullable();
            $table->string('so_tai_khoan')->nullable();
            //$table->string('hinh_thuc')->nullable();
            $table->integer('TrangThai')->default(0)->comment('0: Chưa xác nhận, 1: Đã xác nhận, 2: Hoàn thành');
            $table->date('ngay_giao_dich')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lich_su_nap_ruts');
    }
};
