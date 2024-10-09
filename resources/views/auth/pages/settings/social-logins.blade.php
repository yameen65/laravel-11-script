<x-settings title="Social Accounts" sub-title="Activate your social logins easly">
    <x-auth.form form-action="{{ route('settings.social_logins_update') }}" enctype="true">
        @method('PUT')

        <x-auth.card card-header="" header-button="">
            <div class="accordion border border-1 mt-3" id="facebook">
                <div class="bg-light p-2">
                    <div class="float-end">
                        <x-auth.input-checkbox data-bs-toggle="collapse" data-bs-target="#facebookAcording"
                            aria-expanded="true" aria-controls="facebookAcording" margin-top="0" name="factivate"
                            id="factivate" label="" value="" />
                    </div>
                    <h5 class="card-title">Facebook Detail</h5>
                </div>

                <div id="facebookAcording" class="collapse p-2" aria-labelledby="headingOne" data-bs-parent="facebook">
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
                                val="{{ $data->facebook_redirect_url }}" required="true"
                                label="Facebook Redirect URL" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion border border-1 mt-3" id="github">
                <div class="bg-light p-2">
                    <div class="float-end">
                        <x-auth.input-checkbox data-bs-toggle="collapse" data-bs-target="#githubAourding"
                            aria-expanded="true" aria-controls="githubAourding" margin-top="0" name="gitactivate"
                            id="gitactivate" label="" value="" />
                    </div>
                    <h5 class="card-title">Github Detail</h5>
                </div>

                <div id="githubAourding" class="collapse p-2" aria-labelledby="githubAourding" data-bs-parent="github">
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
                    </div>
                </div>
            </div>

            <div class="accordion border border-1 mt-3" id="google">
                <div class="bg-light p-2">
                    <div class="float-end">
                        <x-auth.input-checkbox data-bs-toggle="collapse" data-bs-target="#googleAourding"
                            aria-expanded="true" aria-controls="googleAourding" margin-top="0" name="gactivate"
                            id="gactivate" label="" value="" />
                    </div>
                    <h5 class="card-title">Google Detail</h5>
                </div>

                <div id="googleAourding" class="collapse p-2" aria-labelledby="googleAourding"
                    data-bs-parent="google">

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
                    </div>
                </div>
            </div>

            <div class="accordion border border-1 mt-3" id="twitter">
                <div class="bg-light p-2">
                    <div class="float-end">
                        <x-auth.input-checkbox data-bs-toggle="collapse" data-bs-target="#twitterAourding"
                            aria-expanded="true" aria-controls="twitterAourding" margin-top="0" name="tactivate"
                            id="tactivate" label="" value="" />
                    </div>
                    <h5 class="card-title">Twitter Detail</h5>
                </div>

                <div id="twitterAourding" class="collapse p-2" aria-labelledby="twitterAourding"
                    data-bs-parent="twitter">

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
                                val="{{ $data->twitter_redirect_url }}" required="true"
                                label="Twitter Redirect URL" />
                        </div>
                    </div>
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
