<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('vi_tiens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('taixe_id')->nullable();
            $table->string("so_du");
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('vi_tiens');
    }
};
