@extends('layouts.master')

@section('title', 'Work Requests')

@section('content')

    @decorator('navbar', $navbar)

    {!! $workRequests !!}

@endsection
