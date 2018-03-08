<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password_old'=>'required|min:6|alpha_dash',
            'password_new'=>'required|min:6|alpha_dash',
            'password_confirmation'=>'required|same:password_new',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'password_old'=>'旧密码',
            'password_new'=>'新密码',
            'password_confirmation'=>'确认新密码'
        ];
    }
}
