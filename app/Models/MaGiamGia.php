<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaGiamGia extends Model
{
    protected $table = 'ma_giam_gias';
    protected $fillable = [
        'ma_giam_gia',
        'ty_le_giam_gia',
        'ngay_het_han',
    ];
}
