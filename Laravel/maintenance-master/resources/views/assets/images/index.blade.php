@extends('layouts.master')

@section('title', 'Asset Images')

@section('content')

    @include('assets.images.grid.index', compact('asset'))

@endsection
