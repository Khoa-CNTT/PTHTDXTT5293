<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaiXeDoiMatKhauRequest extends FormRequest
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
            'old_password' => ['required'],
            'new_password' => [
                'required',
                'min:6', // Ít nhất 6 ký tự
                'max:32', // Tối đa 32 ký tự
                'regex:/[A-Z]/', // Ít nhất 1 chữ in hoa
                'regex:/[a-z]/', // Ít nhất 1 chữ thường
                'regex:/[0-9]/', // Ít nhất 1 số
                'regex:/[@$!%*?&#]/', // Ít nhất 1 ký tự đặc biệt
                'different:old_password' // Không được trùng với mật khẩu cũ
            ],
            'confirm_password' => ['required', 'same:new_password'], // Xác nhận mật khẩu
        ];
    }
    public function messages()
    {
        return [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ!',
            'new_password.required' => 'Mật khẩu mới không được để trống!',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự!',
            'new_password.max' => 'Mật khẩu không được vượt quá 32 ký tự!',
            'new_password.regex' => 'Mật khẩu phải chứa ít nhất một chữ in hoa, một chữ thường, một số và một ký tự đặc biệt!',
            'new_password.different' => 'Mật khẩu mới không được trùng với mật khẩu cũ!',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới!',
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp với mật khẩu mới!'
        ];
    }
}
