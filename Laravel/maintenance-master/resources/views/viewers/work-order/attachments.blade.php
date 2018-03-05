@if($workOrder->attachments->count() > 0)

    {!!
       $workOrder->attachments
           ->columns([
               'created_at' => 'Added',
               'file_name' => 'File Name',
               'action' => 'Action'
           ])
           ->modify('action', function($attachment) use($workOrder) {
               return $attachment->viewer()->btnActionsForWorkOrderAttachment($workOrder);
           })
           ->render()
   !!}

@else

    <h5>There are currently no attachments to list.</h5>

@endif
