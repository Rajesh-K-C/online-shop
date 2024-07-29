<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
        $categoryId = $this->route('id');
        return [
            'name' => [
                'required',
                'max:30',
                Rule::unique('categories')->ignore($categoryId),
            ],
            'rank' => 'required|integer',
            'description' => 'nullable|max:255',
            'status' => 'required|integer|between:0,1',
            'thumbnail_file' => 'image|mimes:jpg,jpeg,png,gif|max:1024',
        ];
    }
}
