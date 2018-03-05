<a href="{{ route('maintenance.admin.groups.destroy', [$group->id]) }}"
   data-method="delete"
   data-token="{{ csrf_token() }}"
   data-title="Delete work order?"
   data-message="Are you sure you want to delete this group? Deleting this group may affect users access to funcionality on the website"
   class="btn btn-app">
    <i class="fa fa-trash-o"></i> Delete
</a>
