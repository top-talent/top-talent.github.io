<a href="{{ route('maintenance.admin.users.destroy', [$user->id]) }}"
   data-method="delete"
   data-token="{{ csrf_token() }}"
   data-title="Delete this user?"
   data-message="Are you sure you want to delete this user? This can have a large cascade effect if the user is attached to certain data."
   class="btn btn-app">
    <i class="fa fa-trash-o"></i> Delete
</a>
