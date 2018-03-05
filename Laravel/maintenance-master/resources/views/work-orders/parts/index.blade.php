@extends('layouts.master')

@section('title', 'Work Order Parts')

@section('content')

    @decorator('navbar', $navbarParts)

    {!! $parts !!}

    @decorator('navbar', $navbarInventory)

    {!! $inventory !!}

@endsection
