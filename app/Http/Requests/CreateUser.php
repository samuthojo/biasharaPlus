<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
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
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|min:8',
            'image_url' => 'nullable|file|image|max:2048',
            'subscription_start_date' => 'required',
            'subscription_end_date' => 'required',
            'total_cc' => 'required',
            'business_id' => 'required',
            'country' => 'required',
        ];
    }

    public function messages()
    {
      return [
          'username.required' => 'The username is required',
          'username.unique' => 'The username exists',
          'email.required' => 'Email address is required',
          'email.email' => 'Email address not valid',
          'email.unique'=> 'Email address exists',
          'phone_number.required' => 'Phone number is required',
          'phone_number.min' => 'Phone number not valid',
          'image_url.file' => 'Errors during picture upload, please try again',
          'image_url.image' => 'Picture extensions allowed are: jpeg, jpg, png',
          'image_url.max' => 'Picture exceeds maximum size of 2MB',
          'subscription_start_date.required' => 'Subscription start date is required',
          'subscription_end_date.required' => 'Subscription end date is required',
          'total_cc.required' => 'total_cc is required',
          'business_id.required' => 'business_id is required',
          'country.required' => 'country is required',
      ];
    }
}
