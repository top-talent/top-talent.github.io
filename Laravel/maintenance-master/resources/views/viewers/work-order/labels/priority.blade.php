@if($workOrder->priority)
    <span class="label label-{{ $workOrder->priority->color  }}">{{ $workOrder->priority->name }}</span>
@else
    <span class="label label-default">None</span>
@endif
