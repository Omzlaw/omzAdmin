<div class="table-responsive">
    <table class="table" id="tests-table">
        <thead>
            <tr>
                <th class="th">ID</th>
                <th class="th">Name/Code</th>
                <th class="th">Display Name</th>
                <th class="th">Description</th>
                <th class="th"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td class="td text-sm leading-5 text-gray-900">
                        {{ $permission->id }}
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        {{ $permission->name }}
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        {{ $permission->display_name }}
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        {{ $permission->description }}
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('permissions.edit', [$permission->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
