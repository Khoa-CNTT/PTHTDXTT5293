<?php

use App\Http\Controllers\ChiTietPhanQuyenController;
use App\Http\Controllers\ChucNangController;
use App\Http\Controllers\ChuyenXeController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\LichSuNapTienController;
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Controllers\PhanQuyenController;
use App\Http\Controllers\QuanTriVienController;
use App\Http\Controllers\TaiXeController;
use App\Http\Controllers\ThanhToanController;
use App\Http\Controllers\ViTienController;
use App\Http\Middleware\KhachHangMiddleware;
use App\Models\ChuyenXe;
use App\Models\LichSuNapRut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ------------------------Khách hàng---------------------------------------------
Route::get('/kiem-tra-tai-khoan-khach-hang', [KhachHangController::class, 'checkCustomer']);

Route::post('/khach-hang/dang-ky', [KhachHangController::class, 'registerUser']);
Route::post('/khach-hang/dang-nhap-tk', [KhachHangController::class, 'loginUser']);
Route::post('/khach-hang/dang-xuat-tk', [KhachHangController::class, 'logoutUser']);
Route::post('/khach-hang/update-tai-khoan', [KhachHangController::class, 'updateAccount'])->middleware("KhachHangMiddle");
Route::post('/khach-hang/delete-tai-khoan', [KhachHangController::class, 'deleteAccount']);
Route::post('/khach-hang/doi-mat-khau', [KhachHangController::class, 'changePassword'])->middleware("KhachHangMiddle");
Route::post('/khach-hang/quen-mat-khau', [KhachHangController::class, 'forgotPassword']);
Route::get('/khach-hang/profile/data', [KhachHangController::class, 'getDataProfile'])->middleware("KhachHangMiddle");
Route::post('/khach-hang/profile/anh-dai-dien', [KhachHangController::class, 'getAvatar'])->middleware("KhachHangMiddle");
Route::post('/khach-hang/quen-mat-khau', [KhachHangController::class, 'forgotPassword']);

Route::post('/khach-hang/them-danh-gia', [DanhGiaController::class, 'create'])->middleware("KhachHangMiddle");
Route::post('/khach-hang/xoa-danh-gia', [DanhGiaController::class, 'delete'])->middleware("KhachHangMiddle");
Route::post('/khach-hang/cap-nhat-danh-gia', [DanhGiaController::class, 'update'])->middleware("KhachHangMiddle");

Route::post('/khach-hang/dat-xe', [ChuyenXeController::class, 'store'])->middleware("KhachHangMiddle");
Route::get('/khach-hang/get-data', [ChuyenXeController::class, 'getData'])->middleware("KhachHangMiddle");
Route::get('/khach-hang/xem-chi-tiet-don', [ChuyenXeController::class, 'show'])->middleware("KhachHangMiddle");
Route::post('/khach-hang/huy-don', [ChuyenXeController::class, 'deleteOrder'])->middleware("KhachHangMiddle");

Route::get('/khach-hang/lich-su-don-hang', [ChuyenXeController::class, 'lichSuKhachHang'])->middleware("KhachHangMiddle");
Route::post('/khach-hang/thanh-toan', [ThanhToanController::class, 'Pay'])->middleware("KhachHangMiddle");


//----------------------------- Admin -----------------------------------------
Route::get('/kiem-tra-tai-khoan-admin', [QuanTriVienController::class, 'checkAdmin']);
Route::post('/admin/dang-nhap', [QuanTriVienController::class, 'logIn']);

Route::post('/admin/khach-hang/kich-hoat-tai-khoan', [KhachHangController::class, 'activateAccount'])->middleware("AdminMiddle");
Route::get('/admin/get-data', [ChuyenXeController::class, 'getAllOrders'])->middleware("AdminMiddle");
Route::post('/admin/cap-nhat-don-dat-xe', [ChuyenXeController::class, 'updateOrder'])->middleware("AdminMiddle");
Route::post('/admin/xoa-don-dat-xe', [ChuyenXeController::class, 'adminDeleteOrder'])->middleware("AdminMiddle");

Route::get('/admin/nhan-vien/data', [QuanTriVienController::class, 'getData'])->middleware("NhanVienMiddle");
Route::post('/admin/nhan-vien/create', [QuanTriVienController::class, 'create'])->middleware("NhanVienMiddle");
Route::post('/admin/nhan-vien/delete', [QuanTriVienController::class, 'destroy'])->middleware("NhanVienMiddle");
Route::post('/admin/nhan-vien/check-mail', [QuanTriVienController::class, 'checkMail'])->middleware("NhanVienMiddle");
Route::post('/admin/nhan-vien/update', [QuanTriVienController::class, 'update'])->middleware("NhanVienMiddle");
Route::post('/admin/nhan-vien/doi-trang-thai', [QuanTriVienController::class, 'changeStatus'])->middleware("NhanVienMiddle");

Route::get('/admin/chuc-nang/data', [ChucNangController::class, 'getData'])->middleware("AdminMiddle");
Route::post('/admin/chi-tiet-phan-quyen/cap-quyen', [ChiTietPhanQuyenController::class, 'capQuyen'])->middleware("AdminMiddle");
Route::post('/admin/chi-tiet-phan-quyen/danh-sach', [ChiTietPhanQuyenController::class, 'getData'])->middleware("AdminMiddle");
Route::post('/admin/chi-tiet-phan-quyen/xoa-quyen', [ChiTietPhanQuyenController::class, 'xoaQuyen'])->middleware("AdminMiddle");

Route::get('/admin/phan-quyen/data', [PhanQuyenController::class, 'getData'])->middleware("AdminMiddle");
Route::post('/admin/phan-quyen/create', [PhanQuyenController::class, 'createData'])->middleware("AdminMiddle");
Route::delete('/admin/phan-quyen/delete/{id}', [PhanQuyenController::class, 'deleteData'])->middleware("AdminMiddle");
Route::put('/admin/phan-quyen/update', [PhanQuyenController::class, 'UpateData'])->middleware("AdminMiddle");
Route::post('/admin/phan-quyen/tim-kiem', [PhanQuyenController::class, 'search'])->middleware("AdminMiddle");

// khách hàng
Route::get('/admin/khach-hang/data', [KhachHangController::class, 'getDataUser'])->middleware("AdminMiddle");
Route::post('/admin/khach-hang/doi-trang-thai', [KhachHangController::class, 'changeStatus'])->middleware("AdminMiddle");
Route::post('/admin/khach-hang/update', [KhachHangController::class, 'update'])->middleware("AdminMiddle");
Route::post('/admin/khach-hang/delete', [KhachHangController::class, 'delete'])->middleware("AdminMiddle");

// tài xế
Route::get('/admin/tai-xe/data', [TaiXeController::class, 'getData'])->middleware("AdminMiddle");
Route::post('/admin/tai-xe/doi-tinh-trang', [TaiXeController::class, 'changeDriver'])->middleware("AdminMiddle");
Route::post('/admin/tai-xe/delete-tai-khoan', [TaiXeController::class, 'deleteAcount'])->middleware("AdminMiddle");
Route::post('/admin/tai-xe/cap-nhat-tai-khoan', [TaiXeController::class, 'update'])->middleware("AdminMiddle");
// Route::post('/admin/tai-xe/them-tai-khoan', [TaiXeController::class, 'create'])->middleware("AdminMiddle");

// chuyến xe
Route::post('/admin/chuyen-xe/doi-trang-thai', [ChuyenXeController::class, 'changeStatus'])->middleware("AdminMiddle");
//------------------------------ Tài xế --------------------------------------------
Route::get('/tai-xe/get-data/profile', [TaiXeController::class, 'getDataProfile']);
Route::get('/kiem-tra-tai-khoan-tai-xe', [TaiXeController::class, 'checkDriver']);
Route::post('/tai-xe/dang-ky', [TaiXeController::class, 'registerDriver']);
Route::post('/tai-xe/dang-nhap', [TaiXeController::class, 'logIn']);
Route::post('/tai-xe/update-tai-khoan', [TaiXeController::class, 'updateAcount'])->middleware("TaiXeMiddle");
Route::post('/tai-xe/doi-mat-khau', [TaiXeController::class, 'changePassword'])->middleware("TaiXeMiddle");


Route::post('/tai-xe/nhan-chuyen-xe', [ChuyenXeController::class, 'nhanChuyenXe'])->middleware("TaiXeMiddle");
Route::get('/tai-xe/danh-sach-don-dat-xe', [ChuyenXeController::class, 'getDriverOrders'])->middleware("TaiXeMiddle");
Route::post('/tai-xe/cap-nhat-don-dat-xe', [ChuyenXeController::class, 'updateStatus'])->middleware("TaiXeMiddle");
Route::post('/tai-xe/xac-nhan-don-dat-xe', [ChuyenXeController::class, 'acceptOrder'])->middleware("TaiXeMiddle");
Route::get('/tai-xe/lich-su-chuyen-xe', [ChuyenXeController::class, 'lichSuChuyenXe'])->middleware("TaiXeMiddle");

Route::get('/tai-xe/hien-thi-so-du', [ViTienController::class, 'getSoDuDriver'])->middleware("TaiXeMiddle");
Route::get('/tai-xe/lich-su-nap-rut', [LichSuNapTienController::class, 'getDataDriver'])->middleware("TaiXeMiddle");
Route::post('/tai-xe/nap-tien', [LichSuNapTienController::class, 'recharge'])->middleware("TaiXeMiddle");
Route::post('/tai-xe/rut-tien', [LichSuNapTienController::class, 'withDrawMoneyDriver'])->middleware("TaiXeMiddle");



//------------------------ Mã giảm giá---------------------------------------
Route::get('/admin/ma-giam-gia/data', [MaGiamGiaController::class, 'getData'])->middleware("AdminMiddle");
Route::get('/ma-giam-gia/kiem-tra', [MaGiamGiaController::class, 'checkCode']);
Route::post('/admin/ma-giam-gia/create', [MaGiamGiaController::class, 'createCode'])->middleware("AdminMiddle");
Route::post('/admin/ma-giam-gia/update', [MaGiamGiaController::class, 'updateCode'])->middleware("AdminMiddle");
Route::post('/admin/ma-giam-gia/delete', [MaGiamGiaController::class, 'deleteCode'])->middleware("AdminMiddle");
Route::post('/admin/ma-giam-gia/doi-trang-thai', [MaGiamGiaController::class, 'changeCode'])->middleware("AdminMiddle");


//---------- ----------Lịch sử nạp rút------------------------------
Route::post('/tai-xe/xoa-lich-xu-giao-dich', [LichSuNapTienController::class, 'deleteGiaoDich'])->middleware("AdminMiddle");
Route::post('/tai-xe/cap-nhat-trang-thai-giao-dich', [LichSuNapTienController::class, 'updateStatus'])->middleware("AdminMiddle");
