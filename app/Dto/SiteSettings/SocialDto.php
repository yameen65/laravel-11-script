<?php

namespace App\Dto\SiteSettings;

class SocialDto
{
    public readonly string $facebook_active;
    public readonly string $facebook_api_key;
    public readonly string $facebook_api_secret;
    public readonly string $facebook_redirect_url;

    public readonly string $github_active;
    public readonly string $github_api_key;
    public readonly string $github_api_secret;
    public readonly string $github_redirect_url;

    public readonly string $google_active;
    public readonly string $google_api_key;
    public readonly string $google_api_secret;
    public readonly string $google_redirect_url;

    public readonly string $twitter_active;
    public readonly string $twitter_api_key;
    public readonly string $twitter_api_secret;
    public readonly string $twitter_redirect_url;

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct($request)
    {
        $this->facebook_active = $request['factivate'];
        $this->facebook_api_key = $request['fapi'];
        $this->facebook_api_secret = $request['fsecret'];
        $this->facebook_redirect_url = $request['furl'];

        $this->github_active = $request['gitactivate'];
        $this->github_api_key = $request['gitapi'];
        $this->github_api_secret = $request['gitsecret'];
        $this->github_redirect_url = $request['giturl'];

        $this->google_active = $request['gactivate'];
        $this->google_api_key = $request['gapi'];
        $this->google_api_secret = $request['gsecret'];
        $this->google_redirect_url = $request['gurl'];

        $this->twitter_active = $request['tactivate'];
        $this->twitter_api_key = $request['tapi'];
        $this->twitter_api_secret = $request['tsecret'];
        $this->twitter_redirect_url = $request['turl'];
    }

    public static function fromRequest($request)
    {
        return new self($request);
    }

    public function toArray()
    {
        return [
            'facebook_api_key' => $this->facebook_api_key,
            'facebook_api_secret' => $this->facebook_api_secret,
            'facebook_redirect_url' => $this->facebook_redirect_url,
            'facebook_active' => $this->facebook_active,

            'github_api_key' => $this->github_api_key,
            'github_api_secret' => $this->github_api_secret,
            'github_redirect_url' => $this->github_redirect_url,
            'github_active' => $this->github_active,

            'google_api_key' => $this->google_api_key,
            'google_api_secret' => $this->google_api_secret,
            'google_redirect_url' => $this->google_redirect_url,
            'google_active' => $this->google_active,

            'twitter_api_key' => $this->twitter_api_key,
            'twitter_api_secret' => $this->twitter_api_secret,
            'twitter_redirect_url' => $this->twitter_redirect_url,
            'twitter_active' => $this->twitter_active,
        ];
    }
}
