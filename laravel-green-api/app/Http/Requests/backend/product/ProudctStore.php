<?php

namespace App\Http\Requests\backend\product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class ProudctStore extends FormRequest
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
            'name' => 'required|unique:products,name',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'thumbnail' => 'required',
            'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Select any category',
            'subcategory_id.required' => 'Select subcategory',
            'brand_id.required' => 'Select any brand',
            'thumbnail.required' => 'Select ThumbnailImage',
            'image.required' => 'Select multiple image',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
