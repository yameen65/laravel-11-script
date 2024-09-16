<x-layouts.auth page-title="All Users">

    @if (auth()->user()->can('add_user'))
        <x-slot name="sideButton">
            <!-- Add user Button -->
            <a href="{{ route('users.create', ['type' => request()->type]) }}" class="btn btn-primary mb-3">
                Add user
            </a>
        </x-slot>
    @endif

    <div class="row" style="min-height: 100vh !important;">
        <div class="col-md-12">
            <x-auth.card card-header="All Users">
                <x-auth.datatable>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Active Package</th>
                            <th>Total Cvs</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['all'] as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                </td>
                                <td>{{ $user?->full_name }}</td>
                                <td>{{ $user?->email }}</td>
                                <td>
                                    @if ($user->package == null)
                                        No package activated
                                    @else
                                        <a href="{{ route('packages.show', $user?->package?->id) }}" target="_blank"
                                            rel="noopener noreferrer">{{ $user?->package?->name }}</a>
                                    @endif

                                </td>

                                <td> {{ $user?->cv_profiles->count() }}

                                <td style="display: flex; justify-content: space-between; align-items: center;">
                                    <!-- View Icon -->
                                    @if (auth()->user()->can('view_user'))
                                        <a href="{{ route('users.show', ['user' => $user?->id, 'type' => request()->type]) }}"
                                            class="btn btn-info btn-sm">
                                            Detail
                                        </a>
                                    @endif

                                    @if (auth()->user()->can('edit_user'))
                                        <!-- Edit Icon -->
                                        <a href="{{ route('users.edit', ['user' => $user?->id, 'type' => request()->type]) }}"
                                            class="btn btn-primary btn-sm">
                                            Edit
                                        </a>
                                    @endif

                                    @if (auth()->user()->can('delete_user'))
                                        <!-- Delete Icon -->
                                        <x-auth.form
                                            form-action="{{ route('users.destroy', ['user' => $user?->id, 'type' => request()->type]) }}">
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                Trash
                                            </button>
                                        </x-auth.form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-auth.datatable>
            </x-auth.card>
        </div>
    </div>

</x-layouts.auth>
