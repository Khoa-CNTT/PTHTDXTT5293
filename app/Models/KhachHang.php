<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class KhachHang extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'khach_hangs';
    protected $fillable = [
        'ho_ten',
        'so_dien_thoai',
        'email',
        'dia_chi',
        'hinh_anh',
        'password',
        'vi_tien',
        'hash_reset',
        'trang_thai',
        'is_active',
        'is_block',
    ];
}
