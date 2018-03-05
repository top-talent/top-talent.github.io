<a href="{{ route('maintenance.assets.calendars.events.destroy', [$asset->id, $calendar->id, $event->id]) }}"
   data-method="DELETE"
   data-token="{{ csrf_token() }}"
   data-title="Are you sure?"
   data-message="Are you sure you want to delete this event? This will also remove all the recurrences of this event."
   class="btn btn-app">
    <i class="fa fa-trash-o"></i> Delete
</a>
