@extends('layouts.pages.main.panel')

@section('panel.head.content')
    Create Work Request
@endsection

@section('panel.body.content')
    {!!
        Form::open([
            'url' => route('maintenance.work-orders.requests.store', [$workRequest->id]),
            'class' => 'form-horizontal ajax-form-post clear-form',
            'method' => 'PUT'
        ])
    !!}

    @include('work-orders.requests.form', [
        'workRequest' => $workRequest,
    ])

    {!! Form::close() !!}
@endsection
