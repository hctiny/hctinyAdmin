<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    protected $_rules = [
        'name'=>'required',
        'role_id' => 'required'
    ];

    protected $_attributes = [
        'user_name'=>'用户名',
        'name'=>'姓名',
        'role_id' => '角色'
    ];
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
        $this->_rules['user_name'] = 'required|unique:users,user_name';
        
        if($this->id){
            $this->_rules['user_name'] = 'required|unique:users,user_name,'.$this->id;
        }
        return $this->_rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return $this->_attributes;
    }
}
