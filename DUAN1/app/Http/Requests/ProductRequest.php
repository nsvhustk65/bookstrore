<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
            'ma_san_pham'=>'required|string|max:255|unique:products,ma_san_pham,'.$this->route('id'),
            'ten_san_pham'=>'required|string|max:255',
            'so_luong'=>'required|integer|min:0',
            'gia_san_pham'=>'required|numeric|min:0',
            'gia_khuyen_mai'=>'required|numeric|min:0|lt:gia_san_pham',
            'mo_ta'=>'string'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'ma_san_pham.required' => 'Mã sản phẩm là bắt buộc.',
            'ma_san_pham.string' => 'Mã sản phẩm phải là chuỗi ký tự.',
            'ma_san_pham.max' => 'Mã sản phẩm không được vượt quá 255 ký tự.',
            'ma_san_pham.unique' => 'Mã sản phẩm này đã tồn tại.',
            'ten_san_pham.required' => 'Tên sản phẩm là bắt buộc.',
            'ten_san_pham.string' => 'Tên sản phẩm phải là chuỗi ký tự.',
            'ten_san_pham.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'so_luong.required' => 'Số lượng là bắt buộc.',
            'so_luong.integer' => 'Số lượng phải là một số nguyên.',
            'so_luong.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'gia_san_pham.required' => 'Giá sản phẩm là bắt buộc.',
            'gia_san_pham.numeric' => 'Giá sản phẩm phải là một số.',
            'gia_san_pham.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',
            'gia_khuyen_mai.required' => 'Giá khuyến mãi là bắt buộc.',
            'gia_khuyen_mai.numeric' => 'Giá khuyến mãi phải là một số.',
            'gia_khuyen_mai.min' => 'Giá khuyến mãi phải lớn hơn hoặc bằng 0.',
            'gia_khuyen_mai.lt' => 'Giá khuyến mãi phải nhỏ hơn giá sản phẩm.',
            'mo_ta.string' => 'Mô tả phải là một chuỗi ký tự.',
        ];
    }
}
