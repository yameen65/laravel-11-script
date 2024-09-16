<x-layouts.auth page-title="Permission detail">
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
        <table class="table table-bordered">
            <tbody>

                <tr>
                    <th>Title</th>
                    <td>{{ $data?->title }}</td>
                </tr>
                <tr>
                    <th>Slug</th>
                    <td>{{ $data?->name }}</td>
                </tr>
                <tr>
                    <th>Guard</th>
                    <td>{{ $data?->guard_name }}</td>
                </tr>
            </tbody>
        </table>
    </x-auth.card>

</x-layouts.auth>
