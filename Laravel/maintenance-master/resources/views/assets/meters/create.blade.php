@extends('layouts.pages.main.panel')

@section('title')
    Create Meter
@endsection

@section('panel.head.content')
    Create a Meter
@endsection

@section('panel.body.content')

    {!!
        Form::open([
            'url' => route('maintenance.assets.meters.store', [$asset->id]),
            'class' => 'form-horizontal',
        ])
    !!}

    @include('assets.meters.form')

    {!! Form::close() !!}

@endsection
