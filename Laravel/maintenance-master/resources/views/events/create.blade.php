@extends('layouts.pages.main.panel')

@section('title', 'Create an Event')

@section('panel.head.content')
    Create Event
@endsection

@section('panel.body.content')
    {!!
        Form::open([
            'url' => route('maintenance.events.store'),
            'class' => 'form-horizontal'
        ])
    !!}

    @include('events.form')

    {!! Form::close() !!}
@endsection
