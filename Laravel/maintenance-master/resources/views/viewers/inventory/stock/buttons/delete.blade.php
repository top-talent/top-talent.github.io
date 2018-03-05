<a href="{{ route('maintenance.inventory.stocks.destroy', [$stock->item->id, $stock->id]) }}"
   data-method="DELETE"
   data-token="{{ csrf_token() }}"
   data-title="Are you sure?"
   data-message="Are you sure you want to delete this stock? All movements will be lost."
   class="btn btn-app no-print">
    <i class="fa fa-trash-o"></i> Delete Stock
</a>
