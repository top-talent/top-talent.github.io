<ul class="nav navbar-left navbar-nav">
    <li class="{{ active()->route('maintenance.inventory.index') }}">
        <a href="{{ route('maintenance.inventory.index') }}">
            <i class="fa fa-list"></i> All Items
        </a>
    </li>
    <li><a href="{{ route('maintenance.inventory.create') }}"><i class="fa fa-plus"></i> New Item</a></li>
</ul>
