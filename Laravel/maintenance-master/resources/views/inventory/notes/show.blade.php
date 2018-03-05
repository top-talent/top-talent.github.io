@extends('layouts.pages.main.panel')

@section('title', 'Viewing Note')

@section('panel.head.content')
    Viewing Note
@endsection

@section('panel.body.content')

    {!! $note->content !!}

@endsection
