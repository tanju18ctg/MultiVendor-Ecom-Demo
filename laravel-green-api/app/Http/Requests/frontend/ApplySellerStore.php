<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApplySellerStore extends FormRequest
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
            'name' => 'required',
            'shop_name' => 'required|unique:sellers,shop_name',
            'address' => 'required',
            'phone' => 'required|unique:sellers|regex:/^([0-9\s\-\+\(\)]*)$/|digits:11|unique:sellers',
            'email' => 'required|email|unique:sellers',
            'password' => 'required|confirmed',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
