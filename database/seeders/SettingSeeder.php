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

        $setting->save();
        $setting->file()->create(['name' => 'logo.svg', 'path' => 'settings/logo.svg', 'type' => 'logo']);
    }
}
