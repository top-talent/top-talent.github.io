<a href="{{ route('maintenance.work-orders.events.index', [$workOrder->id]) }}" class="btn btn-app no-print">
    <i class="fa fa-calendar"></i> Events ({{ $workOrder->events->count() }})
</a>
