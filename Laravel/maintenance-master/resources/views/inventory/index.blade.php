@extends('layouts.master')

@section('title', 'Inventory')

@section('content')

    @decorator('navbar', $navbar)

    {!! $inventory !!}

@endsection
