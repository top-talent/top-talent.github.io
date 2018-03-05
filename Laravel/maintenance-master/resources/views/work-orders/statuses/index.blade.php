@extends('layouts.master')

@section('title', 'Statuses')

@section('content')

    @decorator('navbar', $navbar)

    {!! $statuses !!}

@endsection
