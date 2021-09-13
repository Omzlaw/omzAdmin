<div class="table-responsive">
    <table class="table" id="roles-table">
        <thead>
            <tr>
                <th class="th">ID</th>
                <th class="th">Display Name</th>
                <th class="th">Name</th>
                <th class="th"># Permissions</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td class="td text-sm leading-5 text-gray-900">
                        {{ $role->id }}
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        {{ $role->display_name }}
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        {{ $role->name }}
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        {{ $role->permissions_count }}
                    </td>
                    <td width="120">
                        {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('roles.show', [$role->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            @if (\Laratrust\Helper::roleIsEditable($role))
                            <a href="{{ route('roles.edit', [$role->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            @endif
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
