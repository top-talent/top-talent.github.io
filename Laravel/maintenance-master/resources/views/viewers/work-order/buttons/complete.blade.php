@if(! $workOrder->report)
    <a href="{{ route('maintenance.work-orders.report.create', [$workOrder->id]) }}"
       class="btn btn-app">
        <i class="fa fa-check-circle-o"></i> Complete
    </a>
@endif
