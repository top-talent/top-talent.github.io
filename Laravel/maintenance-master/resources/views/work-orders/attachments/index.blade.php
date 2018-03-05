@extends('layouts.master')

@section('title', 'Work Order Attachments')

@section('content')

    @decorator('navbar', $navbar)

    {!! $attachments !!}

@endsection
