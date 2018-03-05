@extends('layouts.master')

@section('title', 'All Work Orders')

@section('content')

    @decorator('navbar', $navbar)

    {!! $workOrders !!}

@endsection
