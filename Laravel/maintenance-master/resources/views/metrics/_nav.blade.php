<ul class="nav navbar-left navbar-nav">
    <li class="{{ active()->route('maintenance.metrics.index') }}">
        <a href="{{ route('maintenance.metrics.index') }}">
            <i class="fa fa-list"></i> All Metrics
        </a>
    </li>
    <li><a href="{{ route('maintenance.metrics.create') }}"><i class="fa fa-plus"></i> New Metric</a></li>
</ul>
