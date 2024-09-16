<x-layouts.auth page-title="All Permissions">

    <x-auth.card card-header="All Permissions">
        <x-auth.datatable>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Guard</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['all'] as $key => $permission)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $permission?->title }}</td>
                        <td>{{ $permission?->name }}</td>
                        <td>{{ $permission?->guard_name }}</td>

                        <td style="display: flex; justify-content: space-between; align-items: center;">
                            <!-- View Icon -->
                            <a href="{{ route('permissions.show', ['permission' => $permission->id]) }}"
                                class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <!-- Edit Icon -->
                            <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}"
                                class="btn btn-primary btn-sm">
                                Edit
                            </a>

                            <!-- Delete Icon -->
                            <x-auth.form
                                form-action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}">
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this permissions?')">
                                    Trash
                                </button>
                            </x-auth.form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-auth.datatable>
    </x-auth.card>
</x-layouts.auth>
