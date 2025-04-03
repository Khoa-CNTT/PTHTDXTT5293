<?php

use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Middleware\KhachHangMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Khách hàng
Route::get('/kiem-tra-tai-khoan-khach-hang', [KhachHangController::class, 'checkCustomer']);

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

//------------- Admin --------------------------
// khách hàng
Route::get('/admin/khach-hang/data', [KhachHangController::class, 'getDataUser'])->middleware("AdminMiddle");
Route::post('/admin/khach-hang/doi-trang-thai', [KhachHangController::class, 'changeStatus'])->middleware("AdminMiddle");
Route::post('/admin/khach-hang/update', [KhachHangController::class, 'update'])->middleware("AdminMiddle");
Route::post('/admin/khach-hang/delete', [KhachHangController::class, 'delete'])->middleware("AdminMiddle");

// Mã giảm giá
Route::get('/admin/ma-giam-gia/data', [MaGiamGiaController::class, 'getData'])->middleware("AdminMiddle");
Route::get('/ma-giam-gia/kiem-tra', [MaGiamGiaController::class, 'checkCode']);
Route::post('/admin/ma-giam-gia/create', [MaGiamGiaController::class, 'createCode'])->middleware("AdminMiddle");
Route::post('/admin/ma-giam-gia/update', [MaGiamGiaController::class, 'updateCode'])->middleware("AdminMiddle");
Route::post('/admin/ma-giam-gia/delete', [MaGiamGiaController::class, 'deleteCode'])->middleware("AdminMiddle");
Route::post('/admin/ma-giam-gia/doi-trang-thai', [MaGiamGiaController::class, 'changeCode'])->middleware("AdminMiddle");
