<a href="{{ route('maintenance.work-orders.attachments.index', [$workOrder->id]) }}" class="btn btn-app">
    <i class="fa fa-files-o"></i> Attachments ({{ $workOrder->attachments->count() }})
</a>
