<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuAddRequest extends FormRequest
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
            'name' => 'bail|required|max:255|min:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên menu không được để trống',
            'name.max' => 'Tên menu không được quá 255 ký tự',
            'name.min' => 'Tên menu không được dưới 10 ký tự',
        ];
    }
}
