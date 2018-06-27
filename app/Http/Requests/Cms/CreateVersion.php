<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;

class CreateVersion extends FormRequest
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
            'version_number' => 'required|numeric|unique:versions',
            'features' => 'required',
            'critical' =>'required|boolean',
        ];
    }

    public function messages()
    {
      return [
        'version_number.unique' => 'Version number exists',
      ];
    }
}
