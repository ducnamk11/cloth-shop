<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addSliderRequest extends FormRequest
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
            'name' => 'bail|required|min:1,max:1000|unique:sliders',
            'description' => 'bail|required',
            'image_path' => 'bail|image|required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống!',
            'name.min' => 'Tên phải chứa 5 đến 20  kí tự',
            'name.max' => 'Tên phải chứa 5 đến 20  kí tự',
            'name.unique' => 'Tên đã tồn tại',
            'description.required' => 'Mô tả  không được để trống!',
            'description.min' => 'Mô tả phải chứa 5 đến 255  kí tự',
            'description.max' => 'Mô tả phải chứa 5 đến 255  kí tự',
            'image_path.required' => 'Ảnh không được để trống!',
            'image_path.image' => 'Vui lòng chọn file  ảnh!',
        ];
    }
}
