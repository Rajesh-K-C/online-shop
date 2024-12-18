<?php

namespace App\Http\Requests;

use App\Rules\ProductIsActive;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContactRequest extends FormRequest
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
        $name_rule = 'string|max:30|min:2';
        $email_rule = 'email|max:255';
        if (Auth::check()) {
            $name_rule .= '|nullable';
            $email_rule .= '|nullable';
        } else {
            $name_rule = 'required|' . $name_rule;
            $email_rule = 'required|' . $email_rule;
        }

        return [
            'name' => $name_rule,
            'email' => $email_rule,
            'message' => 'required|string|min:10|max:1000',
        ];
    }
}
