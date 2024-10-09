<?php

namespace App\Http\Requests\SiteSettings;

use Illuminate\Foundation\Http\FormRequest;

class SocialLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'factivate' => 'nullable|boolean',
            'fapi' => 'required|string|min:32|max:64',
            'fsecret' => 'required|string|min:32|max:64',
            'furl' => 'required|url',

            'gitactivate' => 'nullable|boolean',
            'gitapi' => 'required|string|min:32|max:64',
            'gitsecret' => 'required|string|min:32|max:64',
            'giturl' => 'required|url',

            'gactivate' => 'nullable|boolean',
            'gapi' => 'required|string|min:32|max:64',
            'gsecret' => 'required|string|min:32|max:64',
            'gurl' => 'required|url',

            'tactivate' => 'nullable|boolean',
            'tapi' => 'required|string|min:32|max:64',
            'tsecret' => 'required|string|min:32|max:64',
            'turl' => 'required|url',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'fapi.required' => 'The Facebook API key is required.',
            'fapi.string' => 'The Facebook API key must be a valid string.',
            'fapi.min' => 'The Facebook API key must be at least 32 characters.',
            'fapi.max' => 'The Facebook API key cannot exceed 64 characters.',
            'fsecret.required' => 'The Facebook Secret key is required.',
            'fsecret.min' => 'The Facebook Secret key must be at least 32 characters.',
            'fsecret.max' => 'The Facebook Secret key cannot exceed 64 characters.',
            'furl.required' => 'The Facebook Redirect URL is required.',
            'furl.url' => 'The Facebook Redirect URL must be a valid URL.',

            'gitapi.required' => 'The GitHub API key is required.',
            'gitsecret.required' => 'The GitHub Secret key is required.',
            'giturl.required' => 'The GitHub Redirect URL is required.',

            'gapi.required' => 'The Google API key is required.',
            'gsecret.required' => 'The Google Secret key is required.',
            'gurl.required' => 'The Google Redirect URL is required.',

            'tapi.required' => 'The Twitter API key is required.',
            'tsecret.required' => 'The Twitter Secret key is required.',
            'turl.required' => 'The Twitter Redirect URL is required.',
        ];
    }
}
