<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;

class EditProduct extends FormRequest
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
          'category_id' => 'required',
          'name' => 'required',
          'code' => 'required',
          'cc' => 'required|numeric',
          'image' =>  'nullable|file|image|max:2048',
      ];
    }

    public function messages()
    {
      return [
        'category_id.required' => 'Please select a category',
      ];
    }
}
