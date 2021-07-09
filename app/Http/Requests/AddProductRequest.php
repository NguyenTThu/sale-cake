<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:300|string',
            'id_type' => 'required|numberic', 
            'description'=>'required|string',
            'unit_price'=>'required|integer|min:10000',
            'promotion_price'=>'required|integer|min:10000',
            'image'=>'required|filled|image|mimes:jpeg,png,jpg,gif,svg|max:25000',
            'unit'=> 'required|string',
            'new'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Bạn chưa nhập tên bánh',
            'name.max'=>'Tên phòng chỉ có tối đa 300 ký tự',
            'id_type' => 'Bạn chưa nhập id_type',
            'id_type' => 'id_type phải là số',
            'description.required'=>'Bạn chưa nhập mô tả ',
            'unit_price.required'=>'Bạn chưa nhập unit price',
            'unit_price.min'=>'unit price phải lớn hơn 10000 đ',
            'promotion_price.required'=>'Bạn chưa nhập giá khuyến mãi',
            'promotion_price.min'=>'Giá khuyến mãi phải lớn hơn 10000 đ',
            'unit.required'=>'Bạn chưa nhập unit',
            'unit.numberic'=>' unit phải là số',
            'image.required'=>'Bạn chưa chọn ảnh',
            'image.filled'=>'Bạn chưa chọn ảnh',
            'image.max'=>'Kích thước ảnh tối đa là 25Mb',
            'image.image'=>'File bạn upload không phải ảnh',
            'new'=>'Bạn chưa nhập trường new'
        ];
}
