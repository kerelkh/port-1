<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3', 'max:255', 'unique:products,name'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'unit' => ['required', 'alpha'],
            'body' => ['required'],
            'images' => ['required', 'image']
        ];
    }
}
