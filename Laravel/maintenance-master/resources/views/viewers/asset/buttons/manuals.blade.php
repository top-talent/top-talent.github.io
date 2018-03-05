<a href="{{ route('maintenance.assets.manuals.index', [$asset->id]) }}" class="btn btn-app no-print">
    <i class="fa fa-file-text"></i> Manuals ({{ $asset->manuals->count() }})
</a>
