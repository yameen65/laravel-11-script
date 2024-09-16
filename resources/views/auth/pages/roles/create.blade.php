<x-layouts.auth page-title="Create new role">
    <div class="row mb-3">
        <div class="col-md-12">
            <div style="float:right;">
                <a href="{{ route('roles.index') }}" class="btn btn-primary ">
                    Roles
                </a>
            </div>
        </div>
    </div>
    <x-auth.card card-header="">

        <x-auth.form form-action="{{ route('roles.store') }}" enctype="true">


            <x-auth.input-field type="text" name="name" id="name" place="Enter name" val=""
                required="true" label="Name" />


            <x-auth.input-button btn-class="mt-3" btn-value="Add new role" btn-type="submit" />
        </x-auth.form>
    </x-auth.card>
</x-layouts.auth>
