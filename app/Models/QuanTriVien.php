<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuanTriVien extends Model
{
    protected $table = 'quan_tri_viens';
    protected $fillable = [
        'ho_ten',
        'mat_khau',
        'email',
        'so_dien_thoai',
    ];
}
