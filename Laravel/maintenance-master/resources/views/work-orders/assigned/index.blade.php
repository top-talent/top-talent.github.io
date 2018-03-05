@extends('layouts.master')

@section('title', 'Assigned Work Orders')

@section('content')

    @decorator('navbar', $navbar)

    {!! $workOrders !!}

@endsection
