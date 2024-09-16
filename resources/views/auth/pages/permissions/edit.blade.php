<x-layouts.auth page-title="Edit Permission">
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

        <x-auth.form form-action="{{ route('permissions.update', ['permission' => $data->id]) }}" enctype="true">
            @method('PUT')

            <x-auth.input-field type="text" name="title" id="title" place="Enter title"
                val="{{ $data?->title }}" required="true" label="Title" />

            <x-auth.input-button btn-class="mt-3" btn-value="Update permission" btn-type="submit" />
        </x-auth.form>
    </x-auth.card>
</x-layouts.auth>
