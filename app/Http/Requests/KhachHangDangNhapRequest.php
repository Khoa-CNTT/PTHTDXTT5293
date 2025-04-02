<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhachHangDangNhapRequest extends FormRequest
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
            'email' => 'required|email|max:255|exists:khach_hangs,email',
            'password' => 'required|min:5',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Email không được để trống',
            'email.exists' => 'Email không tồn tại',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự!',
        ];
    }
}
