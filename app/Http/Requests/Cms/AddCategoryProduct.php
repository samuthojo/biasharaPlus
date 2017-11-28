<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryProduct extends FormRequest
{
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
          'name' => 'required|unique:products',
          'code' => 'required|unique:products',
          'cc' => 'required|numeric',
          'image' =>  'nullable|file|image|max:2048',
      ];
  }

  public function messages()
  {
    return [
      'name.unique' => 'A product with the same name exists',
      'code.unique' => 'A product with the same code exists',
    ];
  }
}
