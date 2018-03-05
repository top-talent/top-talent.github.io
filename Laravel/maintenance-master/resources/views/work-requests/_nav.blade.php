<ul class="nav navbar-left navbar-nav">
    <li class="{{ active()->route('maintenance.work-requests.index') }}">
        <a href="{{ route('maintenance.work-requests.index') }}">
            <i class="fa fa-list"></i> All Work Requests
        </a>
    </li>
    <li><a href="{{ route('maintenance.work-requests.create') }}"><i class="fa fa-plus"></i> New Work Request</a></li>
</ul>
