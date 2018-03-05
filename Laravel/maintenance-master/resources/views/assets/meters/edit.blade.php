@extends('layouts.pages.main.panel')

@section('title')
    Edit Meter
@endsection

@section('panel.head.content')
    Edit Meter
@endsection

@section('panel.body.content')

    {!!
        Form::open([
            'url' => route('maintenance.assets.meters.update', [$asset->id, $meter->id]),
            'method' => 'PATCH',
            'class' => 'form-horizontal',
        ])
    !!}

    @include('assets.meters.form', compact('meter'))

    {!! Form::close() !!}

@endsection
