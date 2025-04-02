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
            $table->string("ma_giam_gia");
            $table->string("ty_le_giam_gia");
            $table->string("ngay_het_han");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ma_giam_gias');
    }
};
