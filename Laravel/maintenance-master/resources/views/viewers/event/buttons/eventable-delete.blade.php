<a href="{{ action(currentControllerAction('destroy'), [$eventable->id, $event->id]) }}"
   data-method="delete"
   data-token="{{ csrf_token() }}"
   data-title="Delete event?"
   data-message="Are you sure you want to delete this event?"
   class="btn btn-app no-print">
    <i class="fa fa-trash-o"></i> Delete
</a>
