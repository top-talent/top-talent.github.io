@extends('layouts.pages.main.panel')

@section('title', "Edit $resource $category->name")

@section('panel.head.content')
    Edit {{ $resource }} {{ $category->name }}
@endsection

@section('panel.body.content')
    {!!
        Form::open([
            'url' => route($routes['update'], [$category->id]),
            'class' => 'form-horizontal',
            'method' => 'PATCH',
        ])
    !!}

    @include('categories.form', compact('category'))

    {!! Form::close() !!}
@endsection
