<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('thanh_toans', function (Blueprint $table) {
            $table->id();
            $table->integer('chuyen_xe_id');
            $table->double("so_tien_thanh_toan");
            $table->string("phuong_thuc_thanh_toan");
            $table->integer("trang_thai");
            $table->string('ma_giam_gia')->nullable();
            $table->date('thoi_gian_thanh_toan')->nullable();
            $table->string('ma_giao_dich')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('thanh_toans');
    }
};
