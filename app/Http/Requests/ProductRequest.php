<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 'min:3'
            ],
            'category_id' => [
                'required',
            ],
            'image_url' => [
                'required',
                'image',
                'mimes:png,jpeg,jpg,svg,gif',
                'max:2048',
            ]
        ];
    }
}
