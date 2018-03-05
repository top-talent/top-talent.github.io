<a href="{{ route('maintenance.admin.archive.work-orders.restore', [$workOrder->id]) }}"
   data-method="post"
   data-token="{{ csrf_token() }}"
   data-title="Restore Work Order?"
   data-message="Are you sure you want to restore this work order?"
   class="btn btn-app">
    <i class="fa fa-refresh"></i> Restore
</a>
