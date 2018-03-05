@extends('layouts.pages.main.tabbed')

@section('title', 'Viewing Work Request: '.$workRequest->subject)

@section('tab.head.content')
    <li class="active"><a href="#tab_profile" data-toggle="tab">Profile</a></li>
    <li><a href="#tab_updates" data-toggle="tab">Updates</a></li>
@endsection

@section('tab.body.content')
    <div class="tab-pane active" id="tab_profile">

        @if($workRequest->workOrder)
            <a class="btn btn-app"
               href="{{ route('maintenance.work-orders.show', array($workRequest->workOrder->id)) }}">
                <i class="fa fa-search"></i> View Work Order
            </a>
        @else
            <a class="btn btn-app"
               href="{{ route('maintenance.work-orders.requests.create', array($workRequest->id)) }}">
                <i class="fa fa-plus"></i> Create Work Order
            </a>
        @endif

        <a href="{{ route('maintenance.work-requests.edit', [$workRequest->id]) }}" class="btn btn-app">
            <i class="fa fa-edit"></i> Edit
        </a>

        <a href="{{ route('maintenance.work-requests.destroy', [$workRequest->id]) }}"
           class="btn btn-app"
           data-method="delete"
           data-token="{{ csrf_token() }}"
           data-message="Are you sure you want to delete this work request? It will be archived.">
            <i class="fa fa-trash-o"></i> Delete
        </a>

        <h2>Profile</h2>

        <div class="col-md-6">
            {!! $workRequest->viewer()->profile() !!}
        </div>

        <div class="clearfix"></div>
    </div>

    <div class="tab-pane" id="tab_updates">

        <legend>Updates</legend>

        {!! $workRequest->viewer()->updates() !!}

    </div>
@endsection
