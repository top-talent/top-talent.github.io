@extends('layouts.pages.main.panel')

@section('title', 'Create Event')

@section('panel.head.content')
    Create Event
@endsection

@section('panel.body.content')

    {!!
        Form::open([
            'url' => route($routes['store'], [$eventable->id]),
            'class'=>'form-horizontal',
        ])
    !!}

    @include('events.form')

    {!! Form::close() !!}

@endsection
