<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:200',
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=208,min_height=208',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => '用户名已经存在，请修改用户名',
            'name.regex' => '用户名只支持英文、数字、下划线和-',
            'name.between' => '用户名长度必须介于3-25之间',
            'name.required' => '用户名不能为空',
            'avatar.mimes' => '头像图片必须是jpeg,bmp,png,gif的图片',
            'avatar.dimensions' => '图片清晰度不够，宽和高需要208px以上',
        ];
    }
}
