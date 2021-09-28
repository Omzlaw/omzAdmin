<div class="table-responsive">
    <table class="table text-nowrap table table-striped table-bordered" id="roles-table">
        <thead>
            <tr>
                {{-- <th class="th">Id</th> --}}
                <th class="th">Name</th>
                <th class="th"># Roles</th>
                @if (config('laratrust.panel.assign_permissions_to_user'))<th class="th"># Permissions</th>@endif
                <th class="th">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    {{-- <td class="td text-sm leading-5 text-gray-900">
                        {{ $user->getKey() }}
                    </td> --}}
                    <td class="td text-sm leading-5 text-gray-900">
                        {{ $user->name ?? 'The model doesn\'t have a `name` attribute' }}
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        {{ $user->roles_count }}
                    </td>
                    @if (config('laratrust.panel.assign_permissions_to_user'))
                        <td class="td text-sm leading-5 text-gray-900">
                            {{ $user->permissions_count }}
                        </td>
                    @endif
                    <td>
                        <a href="{{ route('roles-assignment.edit', ['roles_assignment' => $user->id, 'model' => $modelKey]) }}"
                            class="text-blue-600 hover:text-blue-900"><i class="far fa-edit"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- @include('adminlte-templates::common.paginate', ['records' => $users]) --}}
    {!! $users->render() !!}
</div>
