{{-- Asset Meters Grid --}}
<section class="panel panel-default panel-grid">

    {{-- Grid: Header --}}
    <header class="panel-heading">

        <nav class="navbar navbar-default navbar-actions">

            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#assets-meters-actions">
                        <span class="fa fa-bars"></span>
                    </button>
                </div>

                {{-- Grid: Actions --}}
                <div class="collapse navbar-collapse" id="assets-meters-actions">

                    <ul class="nav navbar-nav navbar-left">

                        <li class="dropdown">
                            <a href="#" data-grid-exporter class="dropdown-toggle tip" data-toggle="dropdown"
                               role="button" aria-expanded="false" data-original-title="Export">
                                <i class="fa fa-download"></i> <span class="visible-xs-inline">Export</span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" data-download="pdf" data-toggle="tooltip"
                                       data-original-title="Export Results as PDF"><i class="fa fa-file-pdf-o"></i> PDF</a>
                                </li>
                                <li><a href="#" data-download="csv" data-toggle="tooltip"
                                       data-original-title="Export Results as CSV"><i class="fa fa-file-excel-o"></i>
                                        CSV</a></li>
                                <li><a href="#" data-download="json" data-toggle="tooltip"
                                       data-original-title="Export Results as JSON"><i class="fa fa-file-code-o"></i>
                                        JSON</a></li>
                            </ul>
                        </li>

                        <li class="primary">
                            <a href="{{ route('maintenance.assets.meters.create', [$asset->id]) }}"
                               data-toggle="tooltip" data-original-title="Create">
                                <i class="fa fa-plus"></i> <span class="visible-xs-inline">Create</span>
                            </a>
                        </li>

                    </ul>

                    {{-- Grid: Filters --}}
                    <form class="navbar-form navbar-right" method="post" accept-charset="utf-8" data-search
                          data-grid="assets-meters" role="form">

                        <div class="input-group">

                            <span class="input-group-btn">

                                <button class="btn btn-default" type="button" disabled>
                                    Filters
                                </button>

                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"
                                        aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>

                                <ul class="dropdown-menu" role="menu">

                                    <li>
                                        <a data-grid-calendar-preset="day">
                                            <i class="fa fa-calendar"></i> Today
                                        </a>
                                    </li>

                                    <li>
                                        <a data-grid-calendar-preset="week">
                                            <i class="fa fa-calendar"></i> This Week
                                        </a>
                                    </li>

                                    <li>
                                        <a data-grid-calendar-preset="month">
                                            <i class="fa fa-calendar"></i> This Month
                                        </a>
                                    </li>

                                </ul>

                                <button class="btn btn-default hidden-xs" type="button" data-grid-calendar
                                        data-range-filter="created_at">
                                    <i class="fa fa-calendar"></i>
                                </button>

                            </span>

                            <input class="form-control" name="filter" type="text" placeholder="Search">

                            <span class="input-group-btn">

                                <button data-toggle="tooltip" data-original-title="Search" class="btn btn-default"
                                        type="submit">
                                    <span class="fa fa-search"></span>
                                </button>

                                <button data-toggle="tooltip" data-original-title="Refresh" class="btn btn-default"
                                        data-grid="assets-meters" data-reset>
                                    <i class="fa fa-refresh fa-sm"></i>
                                </button>

                            </span>

                        </div>

                    </form>

                </div>

            </div>

        </nav>

    </header>

    {{-- Page header --}}
    <div class="panel-body">

        {{-- Grid: Applied Filters --}}
        <div class="btn-toolbar" role="toolbar" aria-label="data-grid-applied-filters">

            <div id="assets-meters-filters" class="btn-group" data-grid="assets-meters"></div>

        </div>

    </div>

    {{-- Grid: Table --}}
    <div class="table-responsive">

        <table id="assets-meters-results" class="table table-hover"
               data-source="{{ route('maintenance.api.v1.assets.meters.grid', [$asset->id]) }}"
               data-grid="assets-meters">

            <thead>
            <tr>
                <th class="sortable" data-sort="meters.name">Name</th>
                <th class="sortable" data-sort="meters.metric_id">Metric</th>
                <th>Last Reading</th>
                <th>Last Comment</th>
                <th class="sortable" data-sort="meters.user_id">Created By</th>
                <th class="sortable" data-sort="meters.created_at">Created At</th>
            </tr>
            </thead>

            <tbody></tbody>

        </table>

    </div>

    <footer class="panel-footer clearfix">

        {{-- Grid: Pagination --}}
        <div id="assets-meters-pagination" data-grid="assets-meters"></div>

    </footer>

    @include('assets.meters.grid.templates.no-results')
    @include('assets.meters.grid.templates.results')
    @include('layouts.partials.grid.templates.pagination', ['grid' => 'assets-meters'])
    @include('layouts.partials.grid.templates.filters', ['grid' => 'assets-meters'])

</section>

<script>

    $(function () {
        $.datagrid('assets-meters', '#assets-meters-results', '#assets-meters-pagination', '#assets-meters-filters');
    });

</script>