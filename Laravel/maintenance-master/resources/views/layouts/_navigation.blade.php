<header class="navbar navbar-default navbar-static-top" id="top" role="banner">

    <div class="container">

        <div class="navbar-header">

            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar"
                    aria-controls="bs-navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- <a href="{{ route('maintenance.dashboard.index') }}" class="navbar-brand"> -->
            <a href="http://localhost:8000/" class="navbar-brand">
                {{ memorize('site.name', 'Maintenance') }}
            </a>

        </div>

        <nav id="bs-navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav">

                @if(auth()->check())
                    <li class="dropdown {{ active()->route('maintance.work-orders.*') }}" id="work-orders-menu">

                        <a href="#work-orders-menu" rel="resources-menu" class="dropdown-toggle" data-toggle="dropdown"
                           aria-expanded="false">
                            <i class="fa fa-wrench"></i>
                            Work Orders
                            <i class="fa fa-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">

                            <li class="{{ active()->route('maintenance.work-orders.index') }}">
                                <a href="{{ route('maintenance.work-orders.index') }}">
                                    <i class="fa fa-list"></i> All Work Orders
                                </a>
                            </li>

                            <li class="{{ active()->route('maintenance.work-orders.assigned.*') }}">
                                <a href="{{ route('maintenance.work-orders.assigned.index') }}">
                                    <i class="fa fa-user"></i> Assigned
                                </a>
                            </li>

                            <li class="{{ active()->route('maintenance.work-orders.statuses.*') }}">
                                <a href="{{ route('maintenance.work-orders.statuses.index') }}">
                                    <i class="fa fa-info-circle"></i> Statuses
                                </a>
                            </li>

                            <li class="{{ active()->route('maintenance.work-orders.priorities.*') }}">
                                <a href="{{ route('maintenance.work-orders.priorities.index') }}">
                                    <i class="fa fa-exclamation-circle"></i> Priorities
                                </a>
                            </li>

                            <li class="{{ active()->route('maintenance.work-orders.categories.*') }}">
                                <a href="{{ route('maintenance.work-orders.categories.index') }}">
                                    <i class="fa fa-folder"></i> Categories
                                </a>
                            </li>

                        </ul>

                    </li>

                    <li class="dropdown {{ active()->route('maintance.work-orders.*') }}" id="inventory-menu">

                        <a href="#inventory-menu" rel="resources-menu" class="dropdown-toggle" data-toggle="dropdown"
                           aria-expanded="false">
                            <i class="fa fa-dropbox"></i>
                            Inventory
                            <i class="fa fa-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">

                            <li class="{{ active()->route('maintenance.inventory') }}">
                                <a href="{{ route('maintenance.inventory.index') }}">
                                    <i class="fa fa-list"></i> All Items
                                </a>
                            </li>

                            <li class="{{ active()->route('maintenance.inventory.categories') }}">
                                <a href="{{ route('maintenance.inventory.categories.index') }}">
                                    <i class="fa fa-folder"></i> Categories
                                </a>
                            </li>

                        </ul>

                    </li>

                    <li class="dropdown {{ active()->route('maintance.work-orders.*') }}" id="assets-menu">

                        <a href="#assets-menu" rel="resources-menu" class="dropdown-toggle" data-toggle="dropdown"
                           aria-expanded="false">
                            <i class="fa fa-truck"></i>
                            Assets
                            <i class="fa fa-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">

                            <li class="{{ active()->route('maintenance.assets') }}">
                                <a href="{{ route('maintenance.assets.index') }}">
                                    <i class="fa fa-list"></i> All Assets
                                </a>
                            </li>

                            <li class="{{ active()->route('maintenance.assets.categories') }}">
                                <a href="{{ route('maintenance.assets.categories.index') }}">
                                    <i class="fa fa-folder"></i> Categories
                                </a>
                            </li>

                        </ul>

                    </li>

                    <li class="{{ active()->route('maintenance.locations.*') }}">
                        <a href="{{ route('maintenance.locations.index') }}">
                            <i class="fa fa-location-arrow"></i> Locations
                        </a>
                    </li>

                    <li class="{{ active()->route('maintenance.metrics.*') }}">
                        <a href="{{ route('maintenance.metrics.index') }}">
                            <i class="fa fa-anchor"></i>
                            Metrics
                        </a>
                    </li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">

                @if(auth()->check())

                    <li class="dropdown" id="user-menu">

                        <a href="#user-menu" rel="user-menu" class="dropdown-toggle" data-toggle="dropdown"
                           aria-expanded="false">
                            {{ auth()->user()->fullname }}
                            <i class="fa fa-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">

                            <li class="{{ active()->route('profile.*') }}">
                                <a href="#">
                                    <i class="fa fa-user"></i> Profile
                                </a>
                            </li>

                            <li class="divider"></li>

                            @can('backend')
                            <li>
                                <a href="{{ route('orchestra.dashboard') }}">
                                    <i class="fa fa-user-md"></i> Administration
                                </a>
                            </li>
                            @endif

                            <li>
                                <a href="{{ route('maintenance.logout') }}">
                                    <i class="fa fa-sign-out"></i> Logout
                                </a>
                            </li>

                        </ul>

                    </li>

                @else

                    <li>
                        <a href="{{ route('maintenance.login.index') }}">
                            Login
                        </a>
                    </li>

                @endif

            </ul>

        </nav>

    </div>

</header>
