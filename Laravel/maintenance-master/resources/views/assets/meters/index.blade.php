@extends('layouts.master')

@section('title', "All Meters for Asset: $asset->name")

@section('content')

    @include('assets.meters.grid.index')

@endsection
