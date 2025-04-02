<?php

use App\Http\Controllers\KhachHangController;
use App\Http\Middleware\KhachHangMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Khách hàng
Route::get('/khach-hang/data', [KhachHangController::class, 'getDataUser']);
Route::get('/kiem-tra-tai-khoan-khach-hang', [KhachHangController::class, 'activateAccount']);
// Register - Login - Logout
Route::post('/khach-hang/dang-ky', [KhachHangController::class, 'registerUser']);
Route::post('/khach-hang/dang-nhap-tk', [KhachHangController::class, 'loginUser']);
Route::post('/khach-hang/dang-xuat-tk', [KhachHangController::class, 'logoutUser']);

// Profile
Route::post('/khach-hang/update-tai-khoan', [KhachHangController::class, 'updateAccount'])->middleware("KhachHangMiddle");
Route::post('/khach-hang/delete-tai-khoan', [KhachHangController::class, 'deleteAccount']);
Route::post('/khach-hang/doi-mat-khau', [KhachHangController::class, 'changePassword'])->middleware("KhachHangMiddle");
Route::post('/khach-hang/quen-mat-khau', [KhachHangController::class, 'forgotPassword']);
Route::get('/khach-hang/profile/data', [KhachHangController::class, 'getDataProfile'])->middleware("KhachHangMiddle");
