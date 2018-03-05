@if($workOrder->status)
    <span class="label label-{{ $workOrder->status->color  }}">{{ $workOrder->status->name }}</span>
@else
    <span class="label label-default">None</span>
@endif
