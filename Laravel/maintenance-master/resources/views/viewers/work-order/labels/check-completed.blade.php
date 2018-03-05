@if($workOrder->isComplete())
    <span class="label label-success">
        Yes
        <i class="fa fa-check"></i>
    </span>
@else
    <span class="label label-danger">
        No
        <i class="fa fa-times"></i>
    </span>
@endif
