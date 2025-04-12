<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViTienController extends Controller
{
    public function getSoDu()
    {
        $user = Auth::guard('sanctum')->user();
        return view('wallet.index', [
            'soDu' => $user->so_du,
        ]);
    }
}
