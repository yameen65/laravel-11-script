<x-layouts.auth page-title="Edit my profile">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <x-auth.card card-header="My Profile">
                <x-auth.form form-action="{{ route('updatemyprofile') }}" enctype="true">
                    @method('PUT')
                    @if ($data && $data->file)
                        <x-auth.input-field type="file" name="file" id="file" place="" val=""
                            required="" label="Profile Picture" />
                    @else
                        <x-auth.input-field type="file" name="file" id="file" place="" val=""
                            required="true" label="Profile Picture" />
                    @endif

                    <div class="row">
                        <div class="col-6">
                            @if ($data && $data->file)
                                <img src="{{ $data?->fileUrl('profile') }}"
                                    style="width: 150px; height: 150px; object-fit: cover;" class="img-fluid">
                            @else
                                <div class="pt-2">
                                    <img src="{{ asset('dashboard/assets/image/cv/profile-pic-dummy.png') }}"
                                        style="width: 150px; height: 150px; object-fit: cover;" class="img-fluid">
                                </div>
                            @endif
                        </div>
                    </div>

                    <x-auth.input-field type="text" name="first_name" id="first_name" place=""
                        val="{{ $data?->first_name }}" required="true" label="First Name" />

                    <x-auth.input-field type="text" name="last_name" id="last_name" place=""
                        val="{{ $data?->last_name }}" required="true" label="Last Name" />

                    <x-auth.input-field type="text" name="email" id="email" place=""
                        val="{{ $data?->email }}" required="true" label="Email" extra-attributes="readonly" />
                    <x-auth.input-field type="text" name="phone" id="phone" place=""
                        val="{{ $data?->phone }}" required="true" label="Phone" extra-attributes="" />
                    <label for="languages" class="mt-3 "><strong>Select Language</strong></label><br>
                    <select name="languages" id="languages" class="col-12 mt-1" required>

                        <option value="{{ \App\Enum\Language::ENGLISH->value }}"
                            {{ $data?->languages->value === \App\Enum\Language::ENGLISH->value ? 'selected' : '' }}>
                            English
                        </option>
                        <option value="{{ \App\Enum\Language::GERMAN->value }}"
                            {{ $data?->languages->value === \App\Enum\Language::GERMAN->value ? 'selected' : '' }}>
                            German
                        </option>
                        <option value="{{ \App\Enum\Language::FRENCH->value }}"
                            {{ $data?->languages->value === \App\Enum\Language::FRENCH->value ? 'selected' : '' }}>
                            French
                        </option>
                        <option value="{{ \App\Enum\Language::ITALIAN->value }}"
                            {{ $data?->languages->value === \App\Enum\Language::ITALIAN->value ? 'selected' : '' }}>
                            Italian
                        </option>
                    </select><br>
                    <x-auth.input-button btn-class="mt-3" btn-value="Update" btn-type="submit" />
                </x-auth.form>
            </x-auth.card>
        </div>
    </div>
</x-layouts.auth>
