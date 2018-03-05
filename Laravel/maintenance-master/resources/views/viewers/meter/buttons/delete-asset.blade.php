<a href="{{ route('maintenance.assets.meters.destroy', [$asset->id, $meter->id]) }}"
   data-method="delete"
   data-token="{{ csrf_token() }}"
   data-title="Delete meter?"
   data-message="Are you sure you want to delete this meter? All readings will be lost."
   class="btn btn-app no-print">
    <i class="fa fa-trash-o"></i> Delete Meter
</a>
