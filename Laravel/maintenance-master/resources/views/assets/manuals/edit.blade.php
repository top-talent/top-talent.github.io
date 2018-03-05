@extends('layouts.pages.main.panel')

@section('title', 'Edit Manual')

@section('panel.head.content')
    Edit Manual
@endsection

@section('panel.body.content')

    {!!
        Form::open([
            'url' => route('maintenance.assets.manuals.update', [$asset->id, $manual->id]),
            'class' => 'form-horizontal',
            'method' => 'PATCH',
        ])
    !!}

    @include('assets.manuals.form', compact('manual'))

    {!! Form::close() !!}

@endsection
