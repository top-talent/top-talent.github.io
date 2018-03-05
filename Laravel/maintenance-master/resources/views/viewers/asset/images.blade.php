@if($asset->images->count() > 0)

    {!!
        $asset->images
            ->columns([
                'image' => 'Image',
                'created_at' => 'Uploaded',
                'file_name' => 'File Name',
                'action' => 'Action',
            ])
            ->modify('image', function($image) {
                return $image->viewer()->tagImageThumbnail();
            })
            ->modify('action', function($image) use ($asset) {
                return $image->viewer()->btnActionsForAssetImage($asset);
            })
            ->render();
    !!}

@else

    <h5>There are currently no asset images to list.</h5>

@endif
