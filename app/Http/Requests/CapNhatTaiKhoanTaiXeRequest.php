<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapNhatTaiKhoanTaiXeRequest extends FormRequest
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
            'ho_ten'        => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|unique:tai_xes,so_dien_thoai,' . $this->id,
            'email'         => 'required|email|max:255|unique:tai_xes,email,' . $this->id,
            'cccd'          => 'required|string|unique:tai_xes,cccd,' . $this->id,
            'loai_xe'       => 'required|string|max:50',
            'bien_so'       => 'required|string|unique:tai_xes,bien_so,' . $this->id,
            'bang_lai_xe'   => 'required|string|max:100',
            'ngan_hang'     => 'required|string|max:100',
        ];
    }
    public function messages(): array
    {
        return [
            'ho_ten.required' => 'Họ tên không được để trống.',
            'so_dien_thoai.required' => 'Số điện thoại là bắt buộc.',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã được đăng ký.',
            'cccd.required' => 'CCCD không được để trống.',
            'cccd.unique' => 'CCCD đã tồn tại.',
            'loai_xe.required' => 'Loại xe không được để trống.',
            'bien_so.required' => 'Biển số xe không được để trống.',
            'bien_so.unique' => 'Biển số xe đã tồn tại.',
            'bang_lai_xe.required' => 'Bằng lái xe không được để trống.',
            'ngan_hang.required' => 'Ngân hàng không được để trống.',
        ];
    }
}
