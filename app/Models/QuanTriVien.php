<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class QuanTriVien extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'quan_tri_viens';
    protected $fillable = [
        'ho_ten',
        'password',
        'email',
        'dia_chi',
        'so_dien_thoai',
        'tinh_trang',
    ];
}
