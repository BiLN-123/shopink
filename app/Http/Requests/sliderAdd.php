<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sliderAdd extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|min:10',
            'description' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên slider không được để trống',
            'name.max' => 'Tên slider không được quá 255 ký tự',
            'name.min' => 'Tên slider không được dưới 10 ký tự',
            'description.required' => 'Mô tả slider không được để trống',
            'image_path.required' => 'Vui lòng thêm ảnh slider',
            'image_path.image' => 'Ảnh slider không đúng định dạng hoặc dung lượng lớn hơn 4MB',
        ];
    }
}
