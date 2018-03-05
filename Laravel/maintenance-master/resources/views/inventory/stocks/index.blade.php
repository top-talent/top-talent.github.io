@extends('layouts.master')

@section('title', 'Inventory Stocks')

@section('content')

    @decorator('navbar', $navbar)

    {!! $stocks !!}

@endsection
