<x-layouts.auth page-title="Create new Permission">
    <div class="row mb-3">
        <div class="col-md-12">
            <div style="float:right;">
                <a href="{{ route('permissions.index') }}" class="btn btn-primary ">
                    Permissions
                </a>
            </div>
        </div>
    </div>
    <x-auth.card card-header="">

        <x-auth.form form-action="{{ route('permissions.store') }}" enctype="true">

            <x-auth.input-field type="text" name="title" id="title" place="Enter title" val=""
                required="true" label="Title" />

            <x-auth.input-field type="text" name="slug" id="slug" place="Enter slug" val=""
                required="true" label="Slug" />

            <x-auth.input-field type="text" name="guard" id="guard" place="Enter guard" val=""
                required="true" label="Guard Name" />

            <x-auth.input-button btn-class="mt-3" btn-value="Add new permission" btn-type="submit" />
        </x-auth.form>
    </x-auth.card>
</x-layouts.auth>
