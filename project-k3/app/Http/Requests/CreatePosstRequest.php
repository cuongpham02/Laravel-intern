<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePosstRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 'unique:posts,title'],
            'category_id' => 'required',
            'content' => 'required',
        ];
    }

    public function messages() 
    {
        return[
            'unique' => ':attribute đã tồn tại vui lòng chọn Title khác !',
            'category_id.required' => 'Bạn chưa chọn :attribute',
            'required' => ':attribute không được để trống',
        ];
    }

    public function attributes()
    {
        return[
            'title' => 'Title',
            'category_id' => 'Category',
        ];
    }
}
