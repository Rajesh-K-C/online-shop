<?php

namespace App\Http\Requests;

use App\Rules\ProductIsActive;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $name_rule = 'required|string|max:30|unique:products,name';
//        $slug_rule = 'required|string|max:30|unique:products,slug';
        $slug_rule = [
            'required',
            'string',
            'max:30',
            'regex:/^\S*$/',
            ];
        $image_rule = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        if ($id = $this->route('product')) {
            $name_rule .= ',' . $id;
            $slug_rule[] = 'unique:products,slug,' . $id;
//            $slug_rule .= ',' . $id;
            $image_rule .= '|nullable';
        } else {
            $slug_rule[] = 'unique:products,slug';
            $image_rule .= '|required';
        }

        return [
            'product_id' => ['required', 'integer', 'exists:products,id', new ProductIsActive()],
            'quantity' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'The product is required.',
            'product_id.integer' => 'The product must be an integer.',
            'product_id.exists' => 'The selected product does not exist.',
            'quantity.required' => 'The quantity is required.',
            'quantity.integer' => 'The quantity must be an integer.',
            'quantity.min' => 'The quantity must be at least 0.',
        ];
    }
}
