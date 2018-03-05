@if($workOrder->completed_at)
    <span class="label label-success">
        <i class="fa fa-check"></i>
        {!! $workOrder->viewer()->completedAtFormatted() !!}
    </span>
@else
    <span class="label label-danger">
        <i class="fa fa-times"></i>
        No Report has been filled
    </span>
@endif
