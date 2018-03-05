@if(count($event->attendees) > 0)

    {!!
        $event->attendees
                ->columns([
                    'email' => 'Email',
                    'name' => 'Name',
                    'status' => 'Status',
                    'comment' => 'Comment',
                    'action' => 'Action'
                ])
                ->modify('status', function($attendee) {
                    return $attendee->viewer()->status();
                })
                ->modify('action', function($attendee) {
                    return $attendee->viewer()->btnActions();
                })
                ->render()
    !!}

@else
    <h5>There are no attendees to list.</h5>
@endif
