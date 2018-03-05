@extends('layouts.client')

@section('title', 'Viewing Work Request')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">Work Request</div>

        <div class="panel-body">

            <a href="{{ route('maintenance.client.work-requests.edit', [$workRequest->id]) }}" class="btn btn-app">
                <i class="fa fa-edit"></i>Edit
            </a>

            <a href="{{ route('maintenance.client.work-requests.destroy', [$workRequest->id]) }}"
               data-method="delete"
               data-token="{{ csrf_token() }}"
               data-title="Delete work request?"
               data-message="Are you sure you want to delete this work request?"
               class="btn btn-app no-print">
                <i class="fa fa-trash-o"></i> Delete
            </a>

            <h3>Profile</h3>

            <div class="col-md-6">
                {!! $workRequest->viewer()->profile() !!}
            </div>

        </div>

    </div>

    {!! $workRequest->viewer()->clientUpdates() !!}

@endsection
