<a href="{{ route('maintenance.inventory.stocks.movements.rollback', [$item->id, $stock->id, $movement->id]) }}"
   data-method="post"
   data-token="{{ csrf_token() }}"
   data-message="Are you sure you want to rollback this movement?"
   class="btn btn-app no-print">
    <i class="fa fa-refresh"></i> Rollback
</a>
