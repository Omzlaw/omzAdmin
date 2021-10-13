<!-- Application Status Field -->
<div
    class="text-center @if ($application_status == 1)
bg-warning
@elseif ($application_status == 2)
bg-success
@else
bg-danger
@endif"><p class="text-white p-2">{{ get_enum_value('enum_application_status', $application_status) }}</p>
</div>
