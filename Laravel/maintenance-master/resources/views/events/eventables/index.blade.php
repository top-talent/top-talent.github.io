@extends('layouts.pages.main.grid')

@section('title', 'Events')

@section('grid.actions.create')
    <li class="primary">
        <a href="{{ route($routes['create'], $eventable->id) }}" data-toggle="tooltip" data-original-title="Create">
            <i class="fa fa-plus"></i> <span class="visible-xs-inline">Create</span>
        </a>
    </li>
@endsection

@section('grid.table')

    <table id="data-grid" class="results table table-hover" data-source="{{ route($routes['grid'], $eventable->id) }}"
           data-grid="main">

        <thead>
        <tr>
            <th>Title / Summary</th>
            <th class="sortable" data-sort="location_id">Location</th>
            <th>Start</th>
            <th>End</th>
        </tr>
        </thead>

        <tbody></tbody>

    </table>
@endsection

@section('grid.results')
    @include('events.grid.no-results')
    @include('events.grid.results')
    @include('events.grid.pagination')
    @include('events.grid.filters')
@endsection
