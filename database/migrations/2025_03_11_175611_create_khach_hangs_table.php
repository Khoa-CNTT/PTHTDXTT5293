<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->string("ho_ten");
            $table->string("so_dien_thoai");
            $table->string("email")->unique();
            $table->string('dia_chi');
            $table->string("password");
            $table->integer("vi_tien")->default(0);
            $table->integer("trang_thai")->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
    }
};
