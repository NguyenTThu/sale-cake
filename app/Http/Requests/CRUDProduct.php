<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CRUDProduct extends FormRequest
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
            'description'=>'required|max:1000|string',
            'unit_price'=>'required|numeric|min:100000',
            'promotion_price'=>'required|numeric|min:100000',
            'image'=>'required|filled|image|mimes:jpeg,png,jpg,gif,svg|max:25000',//max:25000 là phải 2,5B
            'unit'=>'required|max:300|string',
            'new'=>'required|numeric|min:0',
        ];
    }
}
