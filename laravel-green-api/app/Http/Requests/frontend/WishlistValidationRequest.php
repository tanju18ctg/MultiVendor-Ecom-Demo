<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class WishlistValidationRequest extends FormRequest
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
            'product_id' => 'required|unique:wishlists,user_id',
            // 'required|string|unique: books,title,user_id,'. $request->input('title'),
        ];
    }

    public function messages()
    {
        return [
            "product_id.required" => "Must be select any product",
            "product_id.unique" => "Product Already Has on Wishlist",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
