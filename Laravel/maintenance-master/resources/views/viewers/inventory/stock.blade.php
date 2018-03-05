<div id="inventory-stocks-table">


    @if($item->stocks->count() > 0)

        {!!
            $item->stocks->columns([
                'quantity_metric' => 'Quantity',
                'location' => 'Location',
                'last_movement' => 'Last Movement',
                'last_movement_by' => 'Last Movement By',
                'action' => 'Action',
            ])
            ->means('location', 'location.trail')
            ->modify('action', function($stock){
                return $stock->viewer()->btnActions();
            })
            ->hidden(['last_movement', 'last_movement_by'])
            ->render()

        !!}

    @else
        <h5>There is currently no stock for this item.</h5>
    @endif
</div>
