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
            $table->string('so_sao');
            $table->string('binh_luạn');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('danh_gias');
    }
};
