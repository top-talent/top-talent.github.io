<a href="{{ route('maintenance.assets.work-orders.index', [$asset->id]) }}" class="btn btn-app no-print">
    <i class="fa fa-wrench"></i> Work Orders ({{ $asset->workOrders->count() }})
</a>
