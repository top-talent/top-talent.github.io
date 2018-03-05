@extends('layouts.pages.main.panel')

@section('title', 'Edit Note')

@section('panel.head.content')
    Edit Note
@endsection

@section('panel.body.content')

    {!!
        Form::open([
            'url' => route('maintenance.inventory.notes.update', [$item->id, $note->id]),
            'method' => 'PATCH',
            'class' => 'form-horizontal'
        ])
    !!}

    @include('inventory.notes.form', compact('note'))

    {!! Form::close() !!}

@endsection
