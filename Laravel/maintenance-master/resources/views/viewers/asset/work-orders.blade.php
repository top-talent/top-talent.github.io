@if($workOrders->count() > 0)
    <div id="resource-paginate">
        {!!
            $workOrders->columns([
                'id' => 'ID',
                'status' => 'Status',
                'priority' => 'Priority',
                'subject' => 'Subject',
                'description' => 'Description',
                'action' => 'Action'
            ])
            ->means('status', 'status.label')
            ->means('priority', 'priority.label')
            ->means('description', 'limited_description')
            ->modify('action', function($workOrder){
                return $workOrder->viewer()->btnActions();
            })
            ->render()
        !!}
    </div>

    <div class="text-center">{!! $items->appends(Input::except('page'))->render() !!}</div>
@else
    <h5>There are no work orders attached to this asset.</h5>
@endif
