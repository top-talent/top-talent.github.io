<div id="asset-meters-table">
    @if($asset->meters->count() > 0)
        {!!
            $asset->meters->columns([
                'name' => 'Name',
                'last_reading' => 'Last Reading',
                'last_comment' => 'Comment',
                'created_by' => 'Created By',
                'action' => 'Action',
            ])
            ->means('created_by', 'user.full_name')
            ->means('last_reading', 'last_reading_with_metric')
            ->modify('action', function($meter) use ($asset) {
                return $meter->viewer()->btnActionsForAsset($asset);
            })
            ->render()
        !!}
    @else
        <h5>There are no meters to display for this asset.</h5>
    @endif
</div>
