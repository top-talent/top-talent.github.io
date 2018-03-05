<ul class="nav navbar-left navbar-nav">
    <li class="{{ active()->route('maintenance.work-orders.statuses.index') }}">
        <a href="{{ route('maintenance.work-orders.statuses.index') }}">
            <i class="fa fa-list"></i> All Statuses
        </a>
    </li>
    <li><a href="{{ route('maintenance.work-orders.statuses.create') }}"><i class="fa fa-plus"></i> New Status</a></li>
</ul>
