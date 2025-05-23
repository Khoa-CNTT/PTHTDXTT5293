<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemNhanVienRequest extends FormRequest
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
            'email'         => 'required|email|unique:quan_tri_viens,email',
            'password'      => 'required|min:6',
            'ho_ten'        => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:255',
            'dia_chi'       => 'required|string|max:255',
            'id_chuc_vu'    => 'required|exists:phan_quyens,id',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu là trường bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'ho_ten.required' => 'Họ tên là trường bắt buộc.',
            'ho_ten.string' => 'Họ tên phải là chuỗi.',
            'ho_ten.max' => 'Họ tên không được vượt quá 255 ký tự.',
            'so_dien_thoai.required' => 'Số điện thoại là trường bắt buộc.',
            'so_dien_thoai.string' => 'Số điện thoại phải là chuỗi.',
            'so_dien_thoai.max' => 'Số điện thoại không được vượt quá 255 ký tự.',
            'dia_chi.required' => 'Địa chỉ là trường bắt buộc.',
            'dia_chi.string' => 'Địa chỉ phải là chuỗi.',
            'dia_chi.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'id_chuc_vu.required' => 'Chức vụ là trường bắt buộc.',
            'id_chuc_vu.exists' => 'Chức vụ không tồn tại.',
        ];
    }
}
