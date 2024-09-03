<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name' => 'bail|required|max:255|min:10', //name ở đây phải dùng tên bảng trong db, bail: Dừng kiểm tra nếu có lỗi thì nó sẽ k kiểm tra tiếp
            'price' => 'required|numeric', // numeric: Kiểm tra xem giá có phải là số không
            'category_id' => 'required',
            'contents' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.max' => 'Tên sản phẩm không được quá 255 ký tự',
            'name.min' => 'Tên sản phẩm không được dưới 10 ký tự',
            'price.required' => 'Giá sản phẩm không được để trống',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'category_id.required' => 'Danh mục sản phẩm không được để trống',
            'contents.required' => 'Nội dung sản phẩm không được để trống',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator){
            $name = $this->input('name');
//            $product = Product::where('name', 'LIKE', $name)
//                ->orWhereRaw('name COLLATE utf8mb4_general_ci LIKE ?', [$name]) //nhớ vào localhost để kiểm tra CSDL sử dụng utf8mb4_general_ci hay utf8_general_ci
//                ->first();

            $product = Product::whereRaw('name COLLATE utf8mb4_bin LIKE ?', [$name])->first();
            if($product){
                $validator->errors()->add('name', 'Tên sản phẩm đã tồn tại');
            }
        });
    }
//ILIKE chỉ sử dụng cho Postgres, nếu dùng MySQL thì dùng LIKE
}
