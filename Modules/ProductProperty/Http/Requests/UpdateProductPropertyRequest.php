<?php

namespace Modules\ProductProperty\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductPropertyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            localize_field('name')        => 'required',
            localize_field('description') => 'required',
            'group_id'                         => 'required',
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
