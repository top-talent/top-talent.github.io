<ul class="nav navbar-left navbar-nav">
    <li class="{{ active()->route('maintenance.work-orders.priorities.index') }}">
        <a href="{{ route('maintenance.work-orders.priorities.index') }}">
            <i class="fa fa-list"></i> All Priorities
        </a>
    </li>
    <li><a href="{{ route('maintenance.work-orders.priorities.create') }}"><i class="fa fa-plus"></i> New Priority</a>
    </li>
</ul>
