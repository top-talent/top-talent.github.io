<a class="btn btn-sm btn-primary"
   href="{{ route('maintenance.work-orders.parts.stocks.create', [$workOrder->id, $stock->item->id, $stock->id]) }}">
    <span class="fa fa-plus"></span> Add to Work Order
</a>
