<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('user'),
            'phone' => [
                'required',
                'digits:10',
                'regex:/^9(8|7)\d{8}$/',
            ],
            'city' => 'required|exists:cities,id',
            'address' => 'required|string|min:2|max:255',
        ];
    } 
    public function messages(): array
    {
        return [
            'phone.regex' => 'Invalid phone format',
            'city.exists' => 'The district and city field is required.'
        ];
    }
}
