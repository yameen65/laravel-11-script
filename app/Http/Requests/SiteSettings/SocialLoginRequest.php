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
            'factivate' => 'required|boolean',
            'fapi' => 'required|string|min:32|max:64',
            'fsecret' => 'required|string|min:32|max:64',
            'furl' => 'required|url',

            'gitactivate' => 'required|boolean',
            'gitapi' => 'required|string|min:32|max:64',
            'gitsecret' => 'required|string|min:32|max:64',
            'giturl' => 'required|url',

            'gactivate' => 'required|boolean',
            'gapi' => 'required|string|min:32|max:64',
            'gsecret' => 'required|string|min:32|max:64',
            'gurl' => 'required|url',

            'tactivate' => 'required|boolean',
            'tapi' => 'required|string|min:32|max:64',
            'tsecret' => 'required|string|min:32|max:64',
            'turl' => 'required|url',
        ];
    }
}
