<ul class="nav navbar-left navbar-nav">
    <li class="{{ active()->route('maintenance.work-orders.index') }}">
        <a href="{{ route('maintenance.work-orders.index') }}">
            <i class="fa fa-list"></i> All Work Orders
        </a>
    </li>
    <li class="{{ active()->route('maintenance.work-orders.assigned.index') }}">
        <a href="{{ route('maintenance.work-orders.assigned.index') }}">
            <i class="fa fa-user"></i> Assigned
        </a>
    </li>
    <li><a href="{{ route('maintenance.work-orders.create') }}"><i class="fa fa-plus"></i> New Work Order</a></li>
</ul>
