@if($workOrder->userCheckedIn())
    <a href="{{ route('maintenance.work-orders.sessions.end', [$workOrder->id]) }}"
       data-method="post"
       data-token="{{ csrf_token() }}"
       data-title="Check out?"
       data-message="Are you sure you want to check <b>out</b> this work order?"
       class="btn btn-app"
    >
        <i class="fa fa-clock-o"></i> Check Out
    </a>
@else
    <a href="{{ route('maintenance.work-orders.sessions.start', [$workOrder->id]) }}"
       data-method="post"
       data-token="{{ csrf_token() }}"
       data-title="Check in?"
       data-message="Are you sure you want to check <b>into</b> this work order? Keep in mind once someone checks in for the first time it will 'start' the work order."
       class="btn btn-app"
    >
        <i class="fa fa-clock-o"></i> Check In
    </a>
@endif
