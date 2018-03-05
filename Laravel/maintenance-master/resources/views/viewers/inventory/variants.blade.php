@if($item->variants->count())

    {!!
        $item->variants
            ->columns([
                'id' => 'ID',
                'name' => 'Name',
                'category' => 'Category',
                'current_stock' => 'Current Stock',
                'description' => 'Description',
                'added_on' => 'Added On',
                'action'  => 'Action'
            ])
            ->means('category', 'category.trail')
            ->means('added_on', 'created_at')
            ->modify('current_stock', function ($item) {
                return $item->viewer()->lblCurrentStock;
            })
            ->modify('action', function ($item) {
                return $item->viewer()->btnActions;
            })
            ->hidden(['id', 'added_on', 'description'])
            ->render()
    !!}

@else
    <h5>There are no item variants to list.</h5>
@endif
