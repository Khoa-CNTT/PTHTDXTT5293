<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danh_gias', function (Blueprint $table) {
            $table->id();
            $table->integer('danhgia_id');
            $table->string('so_sao')->comment('Số sao từ 1 đến 5');
            $table->string('binh_luan')->nullable()->comment('Bình luận');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('danh_gias');
    }
};
