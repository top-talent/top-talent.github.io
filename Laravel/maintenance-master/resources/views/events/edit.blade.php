@extends('layouts.pages.main.panel')

@section('title', 'Edit Event')

@section('panel.head.content')
    Edit Event
@endsection

@section('panel.body.content')

    {!!
        Form::open([
            'url' => route('maintenance.events.update', [$event->id]),
            'method' => 'PATCH',
            'class' => 'form-horizontal'
        ])
    !!}

    @include('events.form', compact('event', 'apiObject'))

    {!! Form::close() !!}

@endsection
