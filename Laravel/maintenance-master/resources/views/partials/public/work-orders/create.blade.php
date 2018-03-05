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
    <li class="active">
        <i class="fa fa-plus-circle"></i>
        Submit
    </li>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Submit a new Work Request</h3>
            </div>
            <div class="panel-body">

                {!!
                    Form::open([
                        'url'=>route('maintenance.work-requests.store'),
                        'class'=>'form-horizontal ajax-form-post clear-form'
                    ])
                !!}

                <div class="form-group">
                    <label class="col-sm-2 control-label">Subject</label>

                    <div class="col-md-4">
                        {!! Form::text('subject', null, ['class'=>'form-control', 'placeholder'=>'Enter Subject']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Description / Details</label>

                    <div class="col-md-4">
                        {!! Form::textarea('description', null, ['class'=>'form-control', 'style'=>'min-width:100%', 'placeholder'=>'ex. Added components']) !!}
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
