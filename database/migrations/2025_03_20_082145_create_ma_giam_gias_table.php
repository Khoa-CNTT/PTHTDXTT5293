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
            $table->string('code');
            $table->integer('tinh_trang');
            $table->date('ngay_bat_dau');
            $table->date('ngay_het_han');
            $table->integer('loai_giam_gia')->comment("1: Giảm theo %, 1: Giảm theo số tiền");
            $table->integer('so_giam_gia')->comment("Thể hiện số tiền hoặc % mình sẽ giảm giá");
            $table->integer('so_tien_toi_da');
            $table->integer('so_tien_toi_thieu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ma_giam_gias');
    }
};
