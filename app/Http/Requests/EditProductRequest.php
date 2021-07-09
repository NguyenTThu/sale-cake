<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'description'=>'required|string',
            'unit_price'=>'required|integer|min:10000',
            'promotion_price'=>'required|integer|min:10000',
            'image'=>'required|filled|image|mimes:jpeg,png,jpg,gif,svg|max:25000',
            'id_type' => 'required|numberic', 
            'new'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Bạn chưa nhập tên phòng',
            'name.max'=>'Tên phòng chỉ có tối đa 300 ký tự',
            'description.required'=>'Bạn chưa nhập mô tả phòng',
            'price.required'=>'Bạn chưa nhập giá phòng',
            'price.min'=>'Giá thuê phòng phải lớn hơn 10000 đ',
            'type_room.string' => 'type_room phải là chữ',
            'type_room.required' => 'type_room chưa được nhập',
            'image.required'=>'Bạn chưa chọn ảnh',
            'image.filled'=>'Bạn chưa chọn ảnh',
            'image.max'=>'Kích thước ảnh tối đa là 25Mb',
            'image.image'=>'File bạn upload không phải ảnh',
            'new'=>'Bạn chưa nhập trường new'
        ];
}
