<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhachHangDangkyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:khach_hangs,email',
            'password' => 'required|min:5',
            're_password' => 'required|same:password',
            'so_dien_thoai' => 'required|regex:/^0[0-9]{9}$/|unique:khach_hangs,so_dien_thoai',
            'dia_chi' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'ho_ten.required'         => 'Vui lòng nhập họ tên!',
            'ho_ten.max'              => 'Họ tên không được vượt quá 255 ký tự!',
            'so_dien_thoai.required'  => 'Vui lòng nhập số điện thoại!',
            'so_dien_thoai.unique'    => 'Số điện thoại đã được sử dụng!',
            'so_dien_thoai.regex'     => 'Số điện thoại không hợp lệ!',
            'email.required'          => 'Vui lòng nhập email!',
            'email.email'             => 'Email không hợp lệ!',
            'email.unique'            => 'Email đã tồn tại!',
            'dia_chi.required'        => 'Vui lòng nhập địa chỉ!',
            'password.required'       => 'Vui lòng nhập mật khẩu!',
            'password.min'            => 'Mật khẩu phải có ít nhất 6 ký tự!',
            'password.confirmed'      => 'Xác nhận mật khẩu không khớp!',
            're_password.required'      => 'Mật khẩu không được để trống!',
        ];
    }
}
