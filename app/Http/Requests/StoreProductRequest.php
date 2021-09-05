<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|unique:products,name',
            'measurement_id' => 'required',
            'supplier_id' => 'required',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1'
        ];
    }
}
