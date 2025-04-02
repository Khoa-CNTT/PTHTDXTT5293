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
            $table->string("so_tien_thanh_toan");
            $table->string("phuong_thuc_thanh_toan");
            $table->integer("trang_thai");
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('thanh_toans');
    }
};
