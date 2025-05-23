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
            $table->integer('user_id')->nullable();
            $table->integer('taixe_id')->nullable();
            $table->integer("so_du");
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('vi_tiens');
    }
};
