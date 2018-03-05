@extends('layouts.master')

@section('header')
    <h1>{{ $title }}</h1>
@endsection

@section('breadcrumb')
    <li class="active">
        <i class="fa fa-book"></i>
        My Work Requests
    </li>
@endsection

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">
            <div class="btn-toolbar">
                <a href="{{ route('maintenance.work-requests.create') }}" class="btn btn-primary" data-toggle="tooltip"
                   title="Create a new Work Request">
                    <i class="fa fa-plus"></i>
                    New Work Request
                </a>
            </div>
        </div>

        <div id="resource-paginate" class="panel-body">
            @if($workOrders->count() > 0)
                @include('public.work-orders.table', [
                    'workOrders' => $workOrders
                ])
            @else
                <h5>You have no submitted work requests to display.</h5>
            @endif
        </div>

    </div>

@endsection
