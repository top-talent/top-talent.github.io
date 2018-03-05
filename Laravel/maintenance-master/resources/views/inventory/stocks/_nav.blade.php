<ul class="nav navbar-left navbar-nav">
    <li class="{{ active()->route('maintenance.inventory.stocks.index') }}">
        <a href="{{ route('maintenance.inventory.stocks.index', [$item->getKey()]) }}">
            <i class="fa fa-list"></i> All Stocks
        </a>
    </li>
    <li><a href="{{ route('maintenance.inventory.stocks.create', [$item->getKey()]) }}"><i class="fa fa-plus"></i> New
            Stock</a></li>
</ul>
