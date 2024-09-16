<x-layouts.auth page-title="Roles detail">
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
        <table class="table table-bordered">
            <tbody>

                <tr>
                    <th>Name</th>
                    <td>{{ $data?->name }}</td>
                </tr>
            </tbody>
        </table>
    </x-auth.card>

</x-layouts.auth>
