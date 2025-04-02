<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string("noi_dung");
            $table->date("thoi_gian");
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
