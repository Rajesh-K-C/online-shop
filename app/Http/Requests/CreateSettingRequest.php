<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSettingRequest extends FormRequest
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
            'setting_name' => 'required|max:30',
            'website_name' => 'required|max:30',
            'slogan' => 'nullable|min:0|max:255',
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'favicon_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:200',
            'header_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'footer_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            'phone' => 'nullable|max:20',
            'phone_optional' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'facebook_link' => 'nullable|string|max:255',
            'twitter_link' => 'nullable|string|max:255',
            'instagram_link' => 'nullable|string|max:255',
            'youtube_link' => 'nullable|string|max:255',
            'google_map_link' => 'nullable|string|max:255',
            'about_us' => 'nullable|string|max:1000',
            'opening_hours' => 'nullable|string|max:255',
            'status' => 'required|integer|between:0,1',
        ];
    }
}
