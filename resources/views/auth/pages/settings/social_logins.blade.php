<x-settings title="Social Accounts" sub-title="Change your system settings">
    <x-auth.form form-action="{{ route('settings.social_logins_update') }}" enctype="true">
        @method('PUT')

        {{-- facebook details --}}
        <x-auth.card card-header="Facebook details" header-button="true">
            <div class="row">
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="fapi" id="fapi" place="Enter api"
                        val="{{ $data->facebook_api_key }}" required="true" label="Facebook Api Key" />
                </div>
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="fsecret" id="fsecret" place="Enter name"
                        val="{{ $data->facebook_api_secret }}" required="true" label="Facebook Secret Key" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="furl" id="furl" place="Enter url"
                        val="{{ $data->facebook_redirect_url }}" required="true" label="Facebook Redirect URL" />
                </div>
                <div class="col-md-6">
                    <x-auth.input-checkbox name="factivate" id="factivate" label="Activate Login?" value="" />
                </div>
            </div>
        </x-auth.card>

        {{-- github details --}}
        <x-auth.card card-header="Github details" header-button="">
            <div class="row">
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="gitapi" id="gitapi" place="Enter api"
                        val="{{ $data->github_api_key }}" required="true" label="Github Api Key" />
                </div>
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="gitsecret" id="gitsecret" place="Enter name"
                        val="{{ $data->github_api_secret }}" required="true" label="Github Secret Key" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="giturl" id="giturl" place="Enter url"
                        val="{{ $data->github_redirect_url }}" required="true" label="Github Redirect URL" />
                </div>
                <div class="col-md-6">
                    <x-auth.input-checkbox name="gitactivate" id="gitactivate" label="Activate Login?" value="" />
                </div>
            </div>
        </x-auth.card>

        {{-- google details --}}
        <x-auth.card card-header="Google details" header-button="">
            <div class="row">
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="gapi" id="gapi" place="Enter api"
                        val="{{ $data->google_api_key }}" required="true" label="Google Api Key" />
                </div>
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="gsecret" id="gsecret" place="Enter name"
                        val="{{ $data->google_api_secret }}" required="true" label="Google Secret Key" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="gurl" id="gurl" place="Enter url"
                        val="{{ $data->google_redirect_url }}" required="true" label="Google Redirect URL" />
                </div>
                <div class="col-md-6">
                    <x-auth.input-checkbox name="gitactivate" id="gitactivate" label="Activate Login?"
                        value="" />
                </div>
            </div>
        </x-auth.card>

        {{-- twitter details --}}
        <x-auth.card card-header="Twitter details" header-button="">
            <div class="row">
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="tapi" id="tapi" place="Enter api"
                        val="{{ $data->twitter_api_key }}" required="true" label="Twitter Api Key" />
                </div>
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="tsecret" id="tsecret" place="Enter name"
                        val="{{ $data->twitter_api_secret }}" required="true" label="Twitter Secret Key" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-auth.input-field type="text" name="turl" id="turl" place="Enter url"
                        val="{{ $data->twitter_redirect_url }}" required="true" label="Twitter Redirect URL" />
                </div>
                <div class="col-md-6">
                    <x-auth.input-checkbox name="tactivate" id="tactivate" label="Activate Login?" value="" />
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <x-auth.input-button btn-class="" btn-type="submit"
                        btn-value="{{ __('Update Social Logins') }}" />
                </div>
            </div>
        </x-auth.card>
    </x-auth.form>
</x-settings>
