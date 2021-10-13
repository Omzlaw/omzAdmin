{!! Form::open(['route' => ['licenseTypes.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a title="View" href="{{ route('licenseTypes.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="far fa-eye"></i>
    </a>
    <a title="Edit" href="{{ route('licenseTypes.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="far fa-edit"></i>
    </a>
    {!! Form::button('<i class="far fa-trash-alt"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')",
        'title' => 'Delete',
    ]) !!}
</div>
{!! Form::close() !!}
