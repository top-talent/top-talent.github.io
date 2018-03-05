<ul class="nav navbar-left navbar-nav">
    <li class="{{ active()->route('maintenance.work-orders.attachments.index') }}">
        <a href="{{ route('maintenance.work-orders.attachments.index', [$workOrder->getKey()]) }}">
            <i class="fa fa-list"></i> All Attachments
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-orders.attachments.create', [$workOrder->getKey()]) }}">
            <i class="fa fa-plus"></i>
            Add Attachments
        </a>
    </li>
</ul>
