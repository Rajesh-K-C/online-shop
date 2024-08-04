<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $name_rule = 'required|string|max:30|unique:roles,name';
        if ($id = $this->route('role')) {
            $name_rule .= ',' . $id;
        }
        return [
            'name' => $name_rule,
            'permission' => 'nullable|array',
        ];
    }
}
