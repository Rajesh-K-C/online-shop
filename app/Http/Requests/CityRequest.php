<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
        $name_rule = 'required|string|max:50|unique:cities,name';
        if ($id = $this->route('city')) {
            $name_rule .= ',' . $id;
        }

        return [
            'name' => $name_rule,
            'district_id' => 'required|integer',
            'delivery_charge' => [
                'required',
                'regex:/^\d{2,3}(\.\d{1,2}0*)?$/', // Ensures the value is a float with up to two decimal places
            ],
//            'delivery_charge' => 'required|numeric|min:0',
            'delivery_status' => 'required|integer|between:0,1'
        ];
    }

    public function messages(): array
    {
        return [
            'district_id.required' => 'The district field is required.',
            'delivery_charge.regex' => 'The delivery charge between 10 to 999',
        ];
    }
}
