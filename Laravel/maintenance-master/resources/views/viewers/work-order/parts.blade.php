@if($workOrder->parts->count() > 0)

    <div id="parts-table">

        {!!
            $workOrder->parts->columns([
                'item_id' => 'Item ID',
                'item' => 'Item',
                'quantity_taken' => 'Quantity Taken',
                'taken_from' => 'Taken From',
                'date_taken' => 'Date Taken',
                'put_back' => 'Put Back',
                'put_back_some' => 'Put Back Some',
            ])
            ->means('item_id', 'item.id')
            ->means('item', 'item.name')
            ->means('quantity_taken', 'pivot.quantity')
            ->means('taken_from', 'location.trail')
            ->means('date_taken', 'pivot.created_at')
            ->modify('put_back', function($stock) use ($workOrder) {
                return $stock->viewer()->btnPutBackAllForWorkOrder($workOrder);
            })
            ->modify('put_back_some', function($stock) use ($workOrder) {
                return $stock->viewer()->btnPutBackSomeForWorkOrder($workOrder);
            })
            ->hidden(['item_id', 'taken_from', 'put_back'])
            ->render()
        !!}

    </div>

@else
    <h5>There are currently no parts attached to this work order.</h5>
@endif
