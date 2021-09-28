<div class="table-responsive">
    <table class="table text-nowrap table table-striped table-bordered" id="notifications-table">
        <thead>
            <tr>
                <th>Time</th>
                {{-- <th>Type</th>
        <th>Notifiable Type</th>
        <th>Notifiable Id</th> --}}
        <th>Message</th>
        {{-- <th>Read At</th> --}}
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($notifications as $notification)
            <tr class="@if($notification->read_at == null) text-danger @endif">
                <td>{{ $notification->created_at->diffForHumans(); }}</td>
            <td>{{ substr($notification->data, 0, 10) }}...</td>
                <td width="300">
                    <div class='btn-group'>
                        <a title="View" href="{{ route('notifications.show', [$notification->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    {!! $notifications->render() !!}
</div>
