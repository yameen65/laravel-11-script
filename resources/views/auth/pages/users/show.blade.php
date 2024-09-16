<x-layouts.auth page-title="Users detail">
    <x-auth.card card-header="{{ $data?->full_name }} Detail">
        <table class="table">
            <tbody>
                <tr>
                    <th>Profile</th>
                    <td><img src="{{ $data?->fileUrl() }}" height="70" alt="" srcset=""></td>
                </tr>
                <tr>
                    <th>First Name</th>
                    <td>{{ $data?->first_name }}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{ $data?->last_name }}</td>
                </tr>
                <tr>
                    <th>User Email</th>
                    <td>{{ $data?->email }}</td>
                </tr>
                <tr>
                    <th>Active Package</th>
                    <td>{{ $data?->package?->name }}</td>
                </tr>
                <tr>
                    <th>Billing Cycle</th>
                    <td>{{ $data?->billing_cycle }}</td>
                </tr>
            </tbody>
        </table>

        @if (auth()->user()->can('view_user_cv'))
            <h3 class="">Cv Profiles</h3>

            @foreach ($data->cv_profiles as $cvprofile)
                <a href="{{ route('cv_profiles.show', $cvprofile?->id) }}"
                    class="btn btn-sm btn-primary">{{ $cvprofile?->name }}</a>
            @endforeach
        @endif
    </x-auth.card>

</x-layouts.auth>
