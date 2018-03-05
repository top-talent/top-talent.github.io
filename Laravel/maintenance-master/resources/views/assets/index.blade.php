@extends('layouts.master')

@section('title', 'All Assets')

@section('content')

    @decorator('navbar', $navbar)

    {!! $assets !!}

@endsection
