<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $name_rule = 'required|string|max:30|unique:categories,name';
        $image_rule = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        if ($id = $this->route('category')) {
            $name_rule .= ',' . $id;
            $image_rule .= '|nullable';
        }else{
            $image_rule .= '|required';
        }
        return [
            'name' => $name_rule,
            'rank' => 'required|integer',
            'image_file'=> $image_rule,
            'description' => 'nullable|max:255',
            'status' => 'required|integer|between:0,1',
        ];
    }
}
