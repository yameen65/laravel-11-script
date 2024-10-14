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
            'gitactivate' => 'nullable|boolean',
            'gactivate' => 'nullable|boolean',
            'tactivate' => 'nullable|boolean',
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('fapi', 'required|string|min:32|max:64', function ($input) {
            return $input->factivate;
        });

        $validator->sometimes('fsecret', 'required|string|min:32|max:64', function ($input) {
            return $input->factivate;
        });

        $validator->sometimes('furl', 'required|url', function ($input) {
            return $input->factivate;
        });

        $validator->sometimes('gitapi', 'required|string|min:32|max:64', function ($input) {
            return $input->gitactivate;
        });

        $validator->sometimes('gitsecret', 'required|string|min:32|max:64', function ($input) {
            return $input->gitactivate;
        });

        $validator->sometimes('giturl', 'required|url', function ($input) {
            return $input->gitactivate;
        });

        $validator->sometimes('gapi', 'required|string|min:32|max:64', function ($input) {
            return $input->gactivate;
        });

        $validator->sometimes('gsecret', 'required|string|min:32|max:64', function ($input) {
            return $input->gactivate;
        });

        $validator->sometimes('gurl', 'required|url', function ($input) {
            return $input->gactivate;
        });

        $validator->sometimes('tapi', 'required|string|min:32|max:64', function ($input) {
            return $input->tactivate;
        });

        $validator->sometimes('tsecret', 'required|string|min:32|max:64', function ($input) {
            return $input->tactivate;
        });

        $validator->sometimes('turl', 'required|url', function ($input) {
            return $input->tactivate;
        });
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
