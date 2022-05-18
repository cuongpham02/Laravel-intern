<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        $id = $this->id;
        return [
            'email' => 'required|email|max:255|string',
            'pswd' => 'required|min:5|max:255|string',
        ];
    }

    public function messages() 
    {
        return[          
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
