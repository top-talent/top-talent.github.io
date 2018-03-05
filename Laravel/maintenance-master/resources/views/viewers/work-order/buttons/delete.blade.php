<a href="{{ route('maintenance.work-orders.destroy', [$workOrder->id]) }}"
   data-method="delete"
   data-token="{{ csrf_token() }}"
   data-title="Delete work order?"
   data-message="Are you sure you want to delete this work order? This work order will be archived.
   No data will be lost, however you will not be able to restore it without manager/supervisor permission."
   class="btn btn-app">
    <i class="fa fa-trash-o"></i> Delete
</a>
