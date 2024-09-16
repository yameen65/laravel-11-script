<x-layouts.auth page-title="Assign permission to role">

    @if (auth()->user()->can('all_role'))
        <div class="row mb-3">
            <div class="col-md-12">
                <div style="float:right;">
                    <a href="{{ route('roles.index') }}" class="btn btn-primary ">
                        Roles
                    </a>
                </div>
            </div>
        </div>
    @endif

    <x-auth.card card-header="Assign permission to role">

        <x-auth.form form-action="{{ route('permissions.give', $role->id) }}" enctype="true">
            @method('PUT')

            <div class="row">
                @foreach ($permissions as $permission)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $permission->name }}"
                                id="flexCheckDefault{{ $permission->id }}" name="package_permissions[]">
                            <label class="form-check-label" for="flexCheckDefault{{ $permission->id }}">
                                {{ $permission->title }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <x-auth.input-button btn-class="mt-3" btn-value="Update" btn-type="submit" />
        </x-auth.form>
    </x-auth.card>
</x-layouts.auth>
