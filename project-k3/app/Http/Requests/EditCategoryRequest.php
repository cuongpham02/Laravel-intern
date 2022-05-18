<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,'.$id.',id'],
            'desc' => ['required', 'string'],
        ];
    }

    public function messages() 
    {
        return[
            'unique' => ':attribute đã tồn tại vui lòng chọn Name khác !',
            'required' => ':attribute Không được để trống',
        ];
    }

    public function attributes()
    {
        return[
            'name' => 'Name Category',
        ];
    }
}
