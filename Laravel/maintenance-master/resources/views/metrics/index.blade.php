@extends('layouts.master')

@section('title', 'All Metrics')

@section('content')

    @decorator('navbar', $navbar)

    {!! $metrics !!}

@endsection
