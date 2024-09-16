<x-my-profile title="My Profile" sub-title="Complete detail about my profile">
    <x-auth.card card-header="My Profile" header-button="true">
        <x-auth.form form-action="{{ route('updatemyprofile') }}" enctype="true">
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <x-auth.input-field type="text" name="username" id="username" required="true"
                                place="{{ __('login.username_placeholder') }}" val="{{ auth()->user()->username }}"
                                extraclasses="mb-3" label="{{ __('login.username_label') }}" />
                        </div>

                        <div class="col-md-6">
                            <x-auth.input-field type="text" name="f_name" id="f_name" required="true"
                                place="{{ __('login.first_name_placeholder') }}" val="{{ auth()->user()->first_name }}"
                                extraclasses="mb-3" label="{{ __('login.first_name_label') }}" />
                        </div>
                        <div class="col-md-6">
                            <x-auth.input-field type="text" name="l_name" id="l_name" required="true"
                                place="{{ __('login.last_name_placeholder') }}" val="{{ auth()->user()->last_name }}"
                                extraclasses="mb-3" label="{{ __('login.last_name_label') }}" />
                        </div>

                        <div class="col-md-12">
                            <x-auth.input-field type="email" name="email" id="email" required="true"
                                place="{{ __('login.email_placeholder') }}" val="{{ auth()->user()->email }}"
                                extraclasses="mb-3 disabled" label="{{ __('login.email_label') }}" />
                        </div>

                        <div class="col-md-12">

                            <x-auth.text-area type="text" name="about" id="about" required="true"
                                place="{{ __('login.username_placeholder') }}" val="{{ auth()->user()->about }}"
                                extraclasses="mb-3" label="{{ __('login.biography_label') }}" />

                            <x-auth.input-button btn-class="" btn-type="submit"
                                btn-value="{{ __('login.login_button') }}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <img id="profileImage" alt="Chris Wood" src="{{ auth()->user()->logo() }}"
                            class="rounded-circle img-responsive mt-2" width="128" height="128" />
                        <div class="mt-2">
                            <span class="btn btn-primary" id="uploadButton"><i class="fas fa-upload"></i> Upload</span>
                        </div>
                        <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                        <!-- Hidden file input -->
                        <input type="file" name="file" id="fileInput" accept="image/*" style="display: none;" />
                    </div>
                </div>
            </div>
        </x-auth.form>
    </x-auth.card>

    @section('auth_scripts')
        <script>
            document.getElementById('uploadButton').addEventListener('click', function() {
                // Trigger the file input click when the button is clicked
                document.getElementById('fileInput').click();
            });

            document.getElementById('fileInput').addEventListener('change', function(event) {
                // Get the selected file
                const file = event.target.files[0];
                if (file) {
                    // Create a URL for the selected file
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Update the image source with the uploaded file's data
                        document.getElementById('profileImage').src = e.target.result;
                    };
                    // Read the file as a data URL (base64 encoded)
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endsection
</x-my-profile>
