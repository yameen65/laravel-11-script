<x-settings title="Languages" sub-title="Change your system default language or add new languages for multilingual use">
    <x-auth.card card-header="Languages" header-button="">
        <x-slot:header-custom>
            <x-auth.allowed-languages />
        </x-slot:header-custom>

        <div class="alert alert-danger alert-outline-coloured alert-dismissible text-danger" role="alert">
            <div class="alert-message">
                <strong>{{ __('Take a backup before process!') }}</strong><br>
                {{ __('If you have previously created or edited a language file (JSON), the Generate process will overwrite those files.') }}
            </div>
        </div>

        <x-auth.available-languages />

        <h4 class="mt-3">{{ __('Installed Languages') }}</h4>

        @php
            $defaultLanguage = $setting->default_language;
            $supportedLocales = LaravelLocalization::getSupportedLocales();
            // Filter out the default language and list it first
            $otherLanguages = array_filter(
                $supportedLocales,
                function ($localeCode) use ($defaultLanguage) {
                    return $localeCode !== $defaultLanguage;
                },
                ARRAY_FILTER_USE_KEY,
            );
        @endphp

        {{-- Display default language first --}}
        @if (in_array($defaultLanguage, $setting->installed_languages))
            <div class="bg-light p-2 mt-3">
                <div class="float-end">
                    <x-auth.input-checkbox margin-top="0" name="installed_languages[]"
                        id="installed_languages{{ $defaultLanguage }}" label=""
                        value="{{ in_array($defaultLanguage, $setting->languages) ? 1 : 0 }}" />
                </div>
                <label class="card-title h5"
                    for="installed_languages{{ $defaultLanguage }}">{{ ucfirst($supportedLocales[$defaultLanguage]['native']) }}
                    {{ __('(Default Language)') }}
                </label>
            </div>
        @endif

        {{-- Display other installed languages --}}
        @foreach ($otherLanguages as $localeCode => $properties)
            @if (in_array($localeCode, $setting->installed_languages))
                <div class="bg-light p-2 mt-3">
                    <div class="float-end">
                        <x-auth.input-checkbox margin-top="0" name="installed_languages[]"
                            id="installed_languages{{ $localeCode }}" label=""
                            value="{{ in_array($localeCode, $setting->languages) ? 1 : 0 }}" />
                    </div>
                    <label class="card-title h5"
                        for="installed_languages{{ $localeCode }}">{{ ucfirst($properties['native']) }}
                        @if ($setting->default_language === $localeCode)
                            {{ __('(Default Language)') }}
                        @endif
                    </label>
                </div>
            @endif
        @endforeach

    </x-auth.card>
</x-settings>
