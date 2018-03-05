@if($attendee->status === 'needsAction')
    <span class="label label-info">Needs Action</span>
@elseif($attendee->status === 'declined')
    <span class="label label-danger">Declined</span>
@elseif($attendee->status === 'tentative')
    <span class="label label-warning">Tentative</span>
@else
    <span class="label label-success">Accepted</span>
@endif
