@extends('layouts.pages.main.panel')

@section('title', 'Create Sub-Category')

@section('panel.head.content')
    Create a new Sub-{{ $resource }} for {{ $category->name }}
@endsection

@section('panel.body.content')
    {!!
        Form::open([
            'url'=> route($routes['create-node'], [$category->id]),
            'class'=>'form-horizontal clear-form'
        ])
    !!}

    @include('categories.form', ['category' => $category])

    {!! Form::close() !!}
@endsection
