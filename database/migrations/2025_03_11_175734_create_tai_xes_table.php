<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tai_xes', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten');
            $table->string('so_dien_thoai');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('dia_chi')->nullable();
            $table->string('cccd')->unique();
            $table->string('loai_xe');
            $table->string('bien_so');
            $table->string('bang_lai_xe');
            $table->string('ngan_hang')->nullable();
            $table->integer('trang_thai')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_xes');
    }
};
