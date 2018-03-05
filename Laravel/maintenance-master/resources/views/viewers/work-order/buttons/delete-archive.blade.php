<a href="{{ route('maintenance.admin.archive.work-orders.destroy', [$workOrder->id]) }}"
   data-method="delete"
   data-token="{{ csrf_token() }}"
   data-title="Delete asset?"
   data-message="Are you sure you want to delete this work order? All data for this work order will be lost, and won't be recoverable."
   class="btn btn-app">
    <i class="fa fa-trash-o"></i> Delete (Permanent)
</a>
