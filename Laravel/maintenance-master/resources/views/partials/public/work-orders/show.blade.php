@extends('layouts.master')

@section('header')
    <h1>{{ $title }}</h1>
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ route('maintenance.work-requests.index') }}">
            <i class="fa fa-book"></i>
            My Work Requests
        </a>
    </li>
    <li class="active">
        {{ $workOrder->subject }}
    </li>
@endsection

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">
                Viewing Your Work Request: {{ $workOrder->subject }}
            </h3>
        </div>

        <div class="panel-body">

            <a class="btn btn-app"
               data-target="#notification-modal"
               data-toggle="modal"
            >
                <i class="fa fa-warning"></i>
                Notifications
            </a>

            <a href="{{ route('maintenance.work-requests.edit', [$workOrder->id]) }}" class="btn btn-app">
                <i class="fa fa-edit"></i>
                Edit
            </a>

            <a href="{{ route('maintenance.work-requests.destroy', [$workOrder->id]) }}"
               data-method="delete"
               data-token="{{ csrf_token() }}"
               data-title="Delete your work request?"
               data-message="Are you sure you want to delete this work request?"
               class="btn btn-app">
                <i class="fa fa-trash-o"></i> Delete
            </a>

            <hr>


            <dl class="dl-horizontal">

                @if($workOrder->status instanceof \App\Models\Status)
                    <dt>Status:</dt>
                    <dd>{{ $workOrder->status->getLabel() }}</dd>

                    <p></p>

                @endif

                <dt>Subject:</dt>
                <dd>{{ $workOrder->subject }}</dd>

                <p></p>

                <dt>Description:</dt>
                <dd>{!! $workOrder->description !!}</dd>

                <p></p>
            </dl>
        </div>

    </div>

    @include('work-orders.partials.update-box', ['workOrder'=>$workOrder])

@endsection
