<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ',
            'password.required'  => 'Vui lòng nhập mật khẩu mới',
            'password_confirm.required' => 'Vui lòng nhập mật khẩu giống trên',
            'password_confirm.same' => 'Vui lòng nhập mật khẩu cho đúng'
        ];
    }
}
