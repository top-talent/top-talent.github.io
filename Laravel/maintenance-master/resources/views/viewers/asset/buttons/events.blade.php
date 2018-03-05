<a href="{{ route('maintenance.assets.events.index', [$asset->id]) }}" class="btn btn-app no-print">
    <i class="fa fa-calendar"></i> Events ({{ $asset->events->count() }})
</a>
