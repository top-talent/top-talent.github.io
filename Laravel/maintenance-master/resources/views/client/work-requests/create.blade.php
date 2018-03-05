@extends('layouts.pages.client.panel')

@section('title', 'Create a Work Request')

@section('panel.head.content')
    Create a new Work Request
@endsection

@section('panel.body.content')

    {!!
        Form::open([
            'url' => route('maintenance.client.work-requests.store'),
            'class'=>'form-horizontal'
        ])
    !!}

    @include('client.work-requests.form')

    {!! Form::close() !!}

@endsection
