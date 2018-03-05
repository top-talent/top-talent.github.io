@extends('layouts.master')

@section('title', 'Asset Manuals')

@section('content')

    @include('assets.manuals.grid.index', compact('asset'))

@endsection
