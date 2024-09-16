<x-layouts.auth page-title="All Roles">

    <x-auth.card card-header="All Roles">
        <x-auth.datatable>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['all'] as $key => $role)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $role?->name }}</td>

                        <td style="display: flex; justify-content: space-between; align-items: center;">
                            @if (auth()->user()->can('view_role'))
                                <a href="{{ route('roles.show', ['role' => $role->id]) }}" class="btn btn-info btn-sm">
                                    Detail
                                </a>
                            @endif

                            @if (auth()->user()->can('assign_permission'))
                                <a href="{{ route('permissions.assign', $role->id) }}" class="btn btn-warning btn-sm">
                                    Add or Edit Role Permisssion
                                </a>
                            @endif

                            @if (auth()->user()->can('edit_role'))
                                <a href="{{ route('roles.edit', ['role' => $role->id]) }}" class="btn btn-primary btn-sm">
                                    Edit
                                </a>
                            @endif

                            @if (auth()->user()->can('delete_role'))
                                <x-auth.form form-action="{{ route('roles.destroy', ['role' => $role->id]) }}">
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this roles?')">
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
</x-layouts.auth>
