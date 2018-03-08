<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'menu_name'=>'required',
            'menu_url'=>'required',
            'menu_icon'=>'required',
            'power_name'=>'required'
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
            'menu_name'=>'名称',
            'menu_url'=>'链接',
            'menu_icon'=>'图标',
            'power_name'=>'权限类型'
        ];
    }
}
