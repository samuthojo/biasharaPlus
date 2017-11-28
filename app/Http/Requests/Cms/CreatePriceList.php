<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;

class CreatePriceList extends FormRequest
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
            'name' => 'required|unique:price_lists',
            'effective_date' => 'required',
            'color' => 'required',
        ];
    }

    public function messages()
    {
      return [
        'name.unique' => 'A PriceList with the same name exists',
      ];
    }
}
