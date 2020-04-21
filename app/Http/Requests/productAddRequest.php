<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productAddRequest extends FormRequest
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
            'name'=>'bail|required|min:5,max20|unique:products',
            'price'=>'bail|required|numeric|between:1000,1000000000',
//            'category_id'=>'required',
            'contents'=>'required',
            'feature_image_path'=>'required',
            'image_path'=>'required',
            'tags'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống!',
            'name.min' => 'Tên phải chứa 5 đến 20  kí tự',
            'name.max' => 'Tên phải chứa 5 đến 20  kí tự',
            'name.unique' => 'Tên đã tồn tại',
            'price.required' => 'Giá không được để trống!',
            'feature_image_path.required' => 'Ảnh không được để trống!',
            'image_path.required' => 'Ảnh không được để trống!',
            'tags.required' => 'tag không được để trống!',
            'contents.required' => 'Nội dung không được để trống!',
        ];
    }
}
