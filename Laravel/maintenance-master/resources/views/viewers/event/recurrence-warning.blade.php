@if($event->isRecurrence)
    <div class="alert alert-warning">
        <b>Heads Up!</b> This event is a recurrence of another event. Modifying this event may have some undesirable
        effects.
    </div>
@endif
