<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('phan_hois', function (Blueprint $table) {
            $table->id();
            $table->integer("phanhoi_id");
            $table->integer("admin_id");
            $table->string("noi_dung");
            $table->integer("trang_thai");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phan_hois');
    }
};
