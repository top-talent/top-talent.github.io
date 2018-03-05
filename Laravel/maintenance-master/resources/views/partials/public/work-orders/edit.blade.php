@extends('layouts.master')

@section('header')
    <h1>{{ $title }}</h1>
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ route('maintenance.work-requests.create') }}">
            <i class="fa fa-book"></i>
            My Work Requests
        </a>
    </li>
    <li>
        <a href="{{ route('maintenance.work-requests.show', [$workOrder->id]) }}">
            {{ $workOrder->subject }}
        </a>
    </li>
    <li class="active">
        <i class="fa fa-edit"></i>
        Edit
    </li>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Work Request: {{ $workOrder->subject }}</h3>
            </div>
            <div class="panel-body">

                {!!
                    Form::open([
                        'url' => route('maintenance.work-requests.update', [$workOrder->id]),
                        'method' => 'PATCH',
                        'class' => 'form-horizontal ajax-form-post'
                    ])
                !!}

                <div class="form-group">
                    <label class="col-sm-2 control-label">Subject</label>

                    <div class="col-md-4">
                        {!! Form::text('subject', $workOrder->subject, ['class'=>'form-control', 'placeholder'=>'Enter Subject']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Description / Details</label>

                    <div class="col-md-4">
                        {!! Form::textarea('description', htmlspecialchars($workOrder->description), ['class'=>'form-control', 'style'=>'min-width:100%']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
                    </div>
                </div>

                {!! Form::close() !!}

            </div>

        </div>

    </div>
@endsection
