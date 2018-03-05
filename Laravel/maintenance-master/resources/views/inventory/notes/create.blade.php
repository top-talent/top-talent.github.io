@extends('layouts.pages.main.panel')

@section('title', 'Create Note')

@section('panel.head.content')
    Create Note
@endsection

@section('panel.body.content')
    {!!
        Form::open([
            'url' => route('maintenance.inventory.notes.store', [$item->id]),
            'class' => 'form-horizontal'
        ])
    !!}

    @include('inventory.notes.form')

    {!! Form::close() !!}
@endsection
