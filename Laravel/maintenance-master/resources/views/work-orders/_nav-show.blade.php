<ul class="nav navbar-left navbar-nav">
    <li>
        <a href="{{ route('maintenance.work-orders.events.index', [$workOrder->getKey()]) }}">
            <i class="fa fa-calendar"></i>
            Events
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-orders.parts.index', [$workOrder->getKey()]) }}">
            <i class="fa fa-cogs"></i>
            Parts
            ({{ $workOrder->parts->count() }})
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-orders.attachments.index', [$workOrder->getKey()]) }}">
            <i class="fa fa-copy"></i>
            Attachments
            ({{ $workOrder->attachments->count() }})
        </a>
    </li>
    <li>
        <a href="#">
            <i class="fa fa-users"></i>
            Workers
            ({{ $workOrder->assignments->count() }})
        </a>
    </li>
    <li>
        @if($workOrder->userCheckedIn())
            <a href="{{ route('maintenance.work-orders.sessions.end', [$workOrder->getKey()]) }}"
               data-method="post"
               data-token="{{ csrf_token() }}"
               data-title="Check out?"
               data-message="Are you sure you want to check out this work order?"
            >
                <i class="fa fa-clock-o"></i> Check Out
            </a>
        @else
            <a href="{{ route('maintenance.work-orders.sessions.start', [$workOrder->getKey()]) }}"
               data-method="post"
               data-token="{{ csrf_token() }}"
               data-title="Check in?"
               data-message="Are you sure you want to check into this work order? Keep in mind once someone checks in for the first time it will 'start' the work order."
            >
                <i class="fa fa-clock-o"></i> Check In
            </a>
        @endif
    </li>
    @if(!$workOrder->isComplete())
        <li>
            <a href="{{ route('maintenance.work-orders.report.create', [$workOrder->getKey()]) }}">
                <i class="fa fa-check"></i>
                Complete Work Order
            </a>
        </li>
    @endif
    <li>
        <a href="{{ route('maintenance.work-orders.edit', [$workOrder->getKey()]) }}">
            <i class="fa fa-edit"></i> Edit
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-orders.destroy', [$workOrder->getKey()]) }}"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-title="Delete work order?"
           data-message="Are you sure you want to delete this work order? This work order will be archived.
   No data will be lost, however you will not be able to restore it without manager/supervisor permission.">
            <i class="fa fa-trash-o"></i> Delete
        </a>
    </li>
</ul>
