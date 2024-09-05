<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryAddRequest extends FormRequest
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
            'name' => 'bail|required|max:255|min:5'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được để trống',
            'name.max' => 'Tên danh mục không được quá 255 ký tự',
            'name.min' => 'Tên danh mục không được dưới 5 ký tự',
        ];
    }

    public function withValidator($validator){
        $validator->after(function ($validator){
           $name = $this->input('name');
           $category = Category::whereRaw('name COLLATE utf8mb4_bin LIKE ?', [$name])->first();

           if ($category){
               $validator->errors()->add('name', 'Tên danh mục đã tồn tại');
           }
        });
    }
}
