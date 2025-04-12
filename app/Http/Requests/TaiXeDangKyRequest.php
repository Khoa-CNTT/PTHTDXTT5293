<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaiXeDangKyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ho_ten'        => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|unique:tai_xes,so_dien_thoai',
            'email'         => 'required|email|unique:tai_xes,email',
            'password'      => 'required|string|min:6',
            'dia_chi'       => 'required|string|max:255',
            'cccd'          => 'required|string|unique:tai_xes,cccd',
            'loai_xe'       => 'required|string|max:50',
            'bien_so'       => 'required|string|unique:tai_xes,bien_so',
            'bang_lai_xe'   => 'required|string|max:100',
            'ngan_hang'     => 'required|string|max:100',
        ];
    }
    public function messages()
    {
        return [
            'ho_ten.required'        => 'Họ tên không được để trống.',
            'so_dien_thoai.required' => 'Số điện thoại là bắt buộc.',
            'so_dien_thoai.unique'   => 'Số điện thoại đã tồn tại.',
            'email.required'         => 'Email không được để trống.',
            'email.email'            => 'Email không đúng định dạng.',
            'email.unique'           => 'Email đã được đăng ký.',
            'password.required'      => 'Mật khẩu không được để trống.',
            'cccd.unique'            => 'CCCD đã tồn tại.',
            'bien_so.unique'         => 'Biển số xe đã tồn tại.',
            // bạn có thể thêm các thông báo khác nếu muốn
        ];
    }
}
