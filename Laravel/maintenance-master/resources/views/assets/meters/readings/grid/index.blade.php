{{-- Meter Readings Grid --}}

{{-- Grid: Table --}}
<div class="table-responsive">

    <table id="assets-meters-readings-results" class="table table-hover"
           data-source="{{ route('maintenance.api.v1.assets.meters.readings.grid', [$asset->id, $meter->id]) }}"
           data-grid="assets-meters-readings">

        <thead>
        <tr>
            <th class="sortable" data-sort="meter_readings.reading">Reading</th>
            <th class="sortable" data-sort="meter_readings.comment">Comment</th>
            <th class="sortable" data-sort="meter_readings.user_id">User</th>
            <th class="sortable" data-sort="meter_readings.created_at">Created At</th>
        </tr>
        </thead>

        <tbody></tbody>

    </table>

</div>

<footer class="clearfix text-center">

    {{-- Grid: Pagination --}}
    <div id="assets-meters-readings-pagination" data-grid="assets-meters-readings"></div>

</footer>

@include('assets.meters.readings.grid.templates.no-results')
@include('assets.meters.readings.grid.templates.results')
@include('layouts.partials.grid.templates.pagination', ['grid' => 'assets-meters-readings'])
@include('layouts.partials.grid.templates.filters', ['grid' => 'assets-meters-readings'])
