<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KhachHangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $Account_Login   = Auth::guard('sanctum')->user();
        if ($Account_Login && $Account_Login instanceof \App\Models\KhachHang) {
            return $next($request);
        } else {
            return response()->json("Sai rồi!");
        }
    }
}
