<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = new Setting();

        $setting->name = "LaraAi";
        $setting->url = "https://first-script.local";
        $setting->email = "admin@gmail.com";

        $setting->google_active = 1;
        $setting->google_api_key = "686799458549-l6356s18u1oou9kbe409lvgne95fh250.apps.googleusercontent.com";
        $setting->google_api_secret = "11wTQQ_IoVOzwbwjv1pavO1x";
        $setting->google_redirect_url = "http://127.0.0.1:8000/account/auth/google/callback";

        $setting->github_active = 1;
        $setting->github_api_key = "Ov23liynxbOa40Gi915N";
        $setting->github_api_secret = "b34a436c1124dc3c2abfdbeb88bd1c3367cd186c";
        $setting->github_redirect_url = "http://127.0.0.1:8000/account/auth/github/callback";

        $setting->facebook_active = 1;
        $setting->facebook_api_key = "686799458549-l6356s18u1oou9kbe409lvgne95fh250.apps.googleusercontent.com";
        $setting->facebook_api_secret = "11wTQQ_IoVOzwbwjv1pavO1x";
        $setting->facebook_redirect_url = "http://127.0.0.1:8000/account/auth/google/callback";

        $setting->twitter_active = 1;
        $setting->twitter_api_key = "686799458549-l6356s18u1oou9kbe409lvgne95fh250.apps.googleusercontent.com";
        $setting->twitter_api_secret = "11wTQQ_IoVOzwbwjv1pavO1x";
        $setting->twitter_redirect_url = "http://127.0.0.1:8000/account/auth/google/callback";

        $setting->save();
        $setting->file()->create(['name' => 'logo.svg', 'path' => 'settings/logo.svg', 'type' => 'logo']);
    }
}
