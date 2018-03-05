<ul class="nav navbar-left navbar-nav">
    <li class="{{ active()->route('maintenance.assets.index') }}">
        <a href="{{ route('maintenance.assets.index') }}">
            <i class="fa fa-tag"></i> All Assets
        </a>
    </li>
    <li><a href="{{ route('maintenance.assets.create') }}"><i class="fa fa-plus"></i> New Asset</a></li>
</ul>

