<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TaiXe extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'tai_xes';
    protected $fillable = [
        'ho_ten',
        'so_dien_thoai',
        'email',
        'password',
        'cccd',
        'loai_xe',
        'bien_so',
        'bang_lai_xe',
        //'thong_tin_khach',
        'ngan_hang',
        'trang_thai',
    ];
}
