@extends('layouts.master')

@section('title', 'Select a Stock')

@section('content')

    <h2>Stocks</h2>

    {!! $stocks !!}

    <h2>Item Variants</h2>

    {!! $variants !!}

@endsection
