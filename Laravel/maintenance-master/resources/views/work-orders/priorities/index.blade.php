@extends('layouts.master')

@section('title', 'Priorities')

@section('content')

    @decorator('navbar', $navbar)

    {!! $priorities !!}

@endsection
