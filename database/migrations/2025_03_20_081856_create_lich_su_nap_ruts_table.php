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
            $table->string("so_tien");
            $table->string("loai_giao_dich");
            $table->integer("trang_thai");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lich_su_nap_ruts');
    }
};
