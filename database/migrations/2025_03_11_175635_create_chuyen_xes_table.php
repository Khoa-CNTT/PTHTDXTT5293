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
            $table->string("dia_diem_don");
            $table->string("dia_diem_den");
            $table->string("loai_xe");
            $table->string("gia_tien");
            $table->integer("trang_thai");
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('chuyen_xes');
    }
};
