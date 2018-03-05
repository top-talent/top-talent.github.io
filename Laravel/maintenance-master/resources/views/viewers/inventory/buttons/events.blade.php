<a href="{{ route('maintenance.inventory.events.index', [$item->id]) }}" class="btn btn-app no-print">
    <i class="fa fa-calendar"></i> Events ({{ $item->events->count() }})
</a>
