<ul class="nav navbar-left navbar-nav">
    <li>
        <a href="{{ route('maintenance.inventory.events.index', [$item->id]) }}">
            <i class="fa fa-calendar"></i>
            Events ({{ $item->events->count() }})
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.inventory.sku.regenerate', [$item->getKey()]) }}"
           data-method="PATCH"
           data-token="{{ csrf_token() }}"
           data-title="Are you sure?"
           data-message="Are you sure you want to regenerate the SKU for this item?"
        >
            <i class="fa fa-refresh"></i> Regenerate SKU
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.inventory.edit', [$item->getKey()]) }}">
            <i class="fa fa-edit"></i>
            Edit
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.inventory.destroy', [$item->getKey()]) }}"
           data-method="DELETE"
           data-token="{{ csrf_token() }}"
           data-title="Are you sure?"
           data-message="Are you sure you want to delete this item? This will be archived. No data will be lost, however you will not be able to restore it without manager/supervisor
    permission."
        >
            <i class="fa fa-trash-o"></i> Delete Item
        </a>
    </li>
</ul>
