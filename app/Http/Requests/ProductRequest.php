<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $slug_rule = 'required|string|max:30|unique:products,slug';
        $image_rule = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        if ($id = $this->route('product')) {
            $name_rule .= ',' . $id;
            $slug_rule .= ',' . $id;
            $image_rule .= '|nullable';
        }else{
            $image_rule .= '|required';
        }

        return [
            'name' => $name_rule,
            'slug' => $slug_rule,
            'short_description' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => [
                'required',
                'regex:/^\d{2,8}(\.\d{1,2}0*)?$/',
            ],
            'discount_percent'=> [
                'required',
                'regex:/^\d{1,2}(\.\d{1,2}0*)?$/',
            ],
            'image_file'=> $image_rule,
            'stock'=> 'required|integer|min:0|max:200',
            'rank' => 'required|integer|min:0',
            'status' => 'required|integer|between:0,1',
            'category' => 'required|integer|exists:categories,id',
        ];
    }
    public function messages(): array{
        return [
            'price.regex'=> 'The price is between 10 to 999,999 with a precision 2 decimal places.',
//            'discount_percent.regex'=> 'The discount percent is a precision number.',
        ];
    }
}
