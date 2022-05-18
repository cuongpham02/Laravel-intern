<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'pswd' => ['required', 'min:8', 'max:255'],
        ];
    }

    public function messages() 
    {
        return[
            'unique' => ':attribute đã tồn tại vui lòng chọn Email khác !',
            'required' => ':attribute Không được để trống',
            'min' => ':attribute Không được nhỏ hơn :min',
            'max' => ':attribute Không được lớn hơn :max',
            'email' => ':attribute không đúng định dạng',
        ];
    }

    public function attributes()
    {
        return[
            'email' => 'Email',
            'pswd' => 'Mật Khẩu',
        ];
    }
}
