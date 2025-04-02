<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CapNhatTaiKhoanKhangHangRequest extends FormRequest
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
            'email' => 'required|email|max:255|unique:khach_hangs,email,' . $this->id,
            'so_dien_thoai' => 'required|regex:/^0[0-9]{9}$/|unique:khach_hangs,so_dien_thoai,' . $this->id,
            'dia_chi' => 'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'ho_ten.required' => 'Họ và tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã được sử dụng.',
            'so_dien_thoai.required' => 'Số điện thoại không được để trống.',
            'so_dien_thoai.regex' => 'Số điện thoại phải bắt đầu bằng 0 và có 10 chữ số.',
            'so_dien_thoai.unique' => 'Số điện thoại này đã được sử dụng.',
            'dia_chi.max' => 'Địa chỉ không được quá 255 ký tự.',
            'dia_chi.required' => 'Địa chỉ không được để trống.',
        ];
    }
}
