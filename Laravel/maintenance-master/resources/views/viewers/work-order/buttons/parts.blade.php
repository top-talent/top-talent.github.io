<a href="{{ route('maintenance.work-orders.parts.index', [$workOrder->id]) }}" class="btn btn-app no-print">
    <i class="fa fa-cogs"></i> Parts ({{ $workOrder->parts->count() }})
</a>
