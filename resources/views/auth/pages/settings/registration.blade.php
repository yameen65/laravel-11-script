<x-settings title="Registration setup" sub-title="Activate of deactivate registration features for new users">

    <x-auth.card card-header="Registration setup" header-button="true">
        <x-auth.form form-action="{{ route('settings.registeration_update') }}" enctype="true">
            @method('PUT')

            <div class="bg-light p-2">
                <div class="float-end">
                    <x-auth.input-checkbox margin-top="0" name="registration" id="registration" label=""
                        value="{{ $data['registration'] == 1 ? 1 : 0 }}" />
                </div>
                <label class="card-title h5" for="registration">Enable Registration</label>
            </div>

            <div class="bg-light p-2 mt-3">
                <div class="float-end">
                    <x-auth.input-checkbox margin-top="0" name="on_boarding" id="on_boarding" label=""
                        value="{{ $data['on_boarding'] == 1 ? 1 : 0 }}" />
                </div>
                <label class="card-title h5" for="on_boarding">Enable User On-Boarding</label>
            </div>

        </x-auth.form>
    </x-auth.card>
</x-settings>
