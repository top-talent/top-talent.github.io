@extends('layouts.pages.client.panel')

@section('title', 'Editing Work Request')

@section('panel.head.content')
    Editing Work Request
@endsection

@section('panel.body.content')

    {!!
        Form::open([
            'url' => route('maintenance.client.work-requests.update', [$workRequest->id]),
            'class'=>'form-horizontal',
            'method' => 'PATCH',
        ])
    !!}

    @include('client.work-requests.form', compact('workRequest'))

    {!! Form::close() !!}

@endsection
