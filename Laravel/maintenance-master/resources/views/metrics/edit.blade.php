@extends('layouts.pages.main.panel')

@section('title', "Edit Metric: $metric->name")

@section('panel.head.content')
    Edit Metric
@endsection

@section('panel.body.content')

    {!! $form !!}

@endsection
