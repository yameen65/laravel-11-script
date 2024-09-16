<x-layouts.auth pageTitle="Change password">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <x-auth.card card-header="Change Password">
                <x-auth.form form-action="{{ route('update_password') }}">

                    <x-auth.input-field type="password" name="old_password" id="old_password" place="*********"
                        val="" required="true" label="Old Password" />

                    <x-auth.input-field type="password" name="new_password" id="new_password" place="*********"
                        val="" required="true" label="New Password" />

                    <x-auth.input-field type="password" name="new_password_confirmation" id="new_password_confirmation"
                        place="*********" val="" required="true" label="Confirm New Password" />

                    <x-auth.input-button btn-class="mt-3" btn-value="Change Password" btn-type="submit" />

                </x-auth.form>
            </x-auth.card>
        </div>
    </div>

</x-layouts.auth>
