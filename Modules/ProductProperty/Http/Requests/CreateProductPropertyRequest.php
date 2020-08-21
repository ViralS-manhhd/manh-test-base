<?php

namespace Modules\ProductProperty\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductPropertyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'product_id'                       => 'required|exists:products,id',
            'properties'                       => 'required',
            'property_groups'                  => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
