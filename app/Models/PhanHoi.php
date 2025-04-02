<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanHoi extends Model
{
    protected $table = 'phan_hois';
    protected $fillable = [
        'noi_dung',
        'trang_thai',
    ];
}
