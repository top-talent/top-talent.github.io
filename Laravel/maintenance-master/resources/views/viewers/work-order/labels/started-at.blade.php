@if($workOrder->started_at)
    <span class="label label-success">
        <i class="fa fa-check"></i>
        {!! $workOrder->viewer()->startedAtFormatted() !!}
    </span>
@else
    <span class="label label-danger">
        <i class="fa fa-times"></i>
        Hasn't been started yet
    </span>
@endif
