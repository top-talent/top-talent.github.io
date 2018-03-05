<a href="{{ route('maintenance.assets.destroy', [$asset->id]) }}"
   data-method="delete"
   data-token="{{ csrf_token() }}"
   data-title="Delete asset?"
   data-message="Are you sure you want to delete this asset? This asset will archived. No data will be lost, however you will not be able to restore it without manager/supervisor
    permission."
   class="btn btn-app no-print">
    <i class="fa fa-trash-o"></i> Delete
</a>
