<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePayment extends FormRequest
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
            'sender' => 'required',
            'amount' => 'required|integer',
            'date_payed' => 'required',
            'operator_type' => 'required',
            'reference_no' => 'required',
            'total_to_date' => 'required|integer',
        ];
    }
}
