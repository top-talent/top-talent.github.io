@extends('layouts.pages.main.panel')

@section('title', 'Edit Event')

@section('panel.head.content')
    Edit Event
@endsection

@section('panel.body.content')

    {!!
        Form::open([
            'url' => route($routes['update'], [$eventable->id, $event->id]),
            'method' => 'PATCH',
            'class' => 'form-horizontal'
        ])
    !!}

    @include('events.form', [
        'event' => $event
    ])

    {!! Form::close() !!}

@endsection
